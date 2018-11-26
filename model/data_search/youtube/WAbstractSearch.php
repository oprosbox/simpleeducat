<?php

require_once '/./../../../library/vendor/autoload.php';

class YoutubeObject {

    public function get_key_develop() {
        return $this->key_develop;
    }

    public function get_sertificate_ssl() {
        return $this->sertificate_ssl;
    }

    public function set_key_develop($key_develop) {
        $this->key_develop = $key_develop;
        return $this;
    }

    public function set_sertificate_ssl($sertificate_ssl) {
        $this->sertificate_ssl = $sertificate_ssl;
        return $this;
    }

    protected $http, $client, $youtube;
    protected $key_develop, $sertificate_ssl;

    public function create() {
        if ($this->sertificate_ssl)
            $this->http = new GuzzleHttp\Client(['verify' => $this->sertificate_ssl]);
        $this->client = new Google_Client();
        if ($this->sertificate_ssl)
            $this->client->setHttpClient($this->http);
        $this->client->setDeveloperKey($this->key_develop);
        $this->youtube = new Google_Service_YouTube($this->client);
    }

}

class WAbstractSearch extends YoutubeObject {

       private function search_simple($object, $funct, $part, $param, $maxResults = 0) {
        $result_return = array();
        if ($maxResults <= 0) {
            $maxResults = 5000000;
        }
        do {
            if ($maxResults - 50 >= 0) {
                $param['maxResults'] = 50;
            } else {
                $param['maxResults'] = $maxResults % 50;
            }
            $maxResults -= 50;
            $result_question = $object->$funct($part, $param);
            $param['pageToken'] = $result_question['nextPageToken'];
            foreach ($result_question['items'] as $resource)
                $result_return[] = $resource;
        } while (($maxResults > 0) && ($result_question['nextPageToken'] !== null));
        return $result_return;
    }

    protected function search_video($question, $duration = 'long', $maxResults = 0) {
        if (!empty($this->youtube)) {
            $param = array("videoDuration" => $duration,
                "q" => $question,
                "type" => "video");
             $funct="listSearch";
            $part="id,snippet";
            $object=$this->youtube->search;
            $result_return = $this->search_simple($object,$funct,$part,$param,$maxResults);
            return $result_return;
        }
    }

    protected function search_channel($question, $maxResults = 0) {
        if (!empty($this->youtube)) {
            $param = array("q" => $question,
                "type" => "channel");
            $funct="listSearch";
            $part="id,snippet";
            $object=$this->youtube->search;
            $result_return = $this->search_simple($object,$funct,$part,$param,$maxResults);
        }
        return $result_return;
    }

    protected function search_playlist($question, $maxResults = 0) {
        if (!empty($this->youtube)) {
            $param = array("pageToken" => '',
                "q" => $question,
                "type" => "playlist");
            $funct="listSearch";
            $part="id,snippet";
            $object=$this->youtube->search;
            $result_return = $this->search_simple($object,$funct,$part,$param,$maxResults);
            return $result_return;
        }
    }

    protected function search_video_by_idPlayList($playlistId, $maxResults = 0) {
        if (!empty($this->youtube)) {
            $param = array('playlistId' => $playlistId);
            $funct="listPlaylistItems";
            $part="snippet,contentDetails";
            $object=$this->youtube->playlistItems;
            $result_return = $this->search_simple($object,$funct,$part,$param,$maxResults);
            return $result_return;
        }
    }

    protected function search_playList_by_idVideo($id_video, $maxResults = 0) {
        if (!empty($this->youtube)) {
            $param = array('videoId' => $id_video);
            $funct="listPlaylistItems";
            $part="snippet,playlistId";
            $object=$this->youtube->playlistItems;
            $result_return = $this->search_simple($object,$funct,$part,$param,$maxResults);
            return $result_return;
        }
    }

    protected function search_lists_by_idChannel($id_channel, $maxResults = 0) {
        if (!empty($this->youtube)) {
            $param = array('channelId' => $id_channel);
            $funct="listPlaylists";
            $part="id,snippet";
            $object=$this->youtube->playlists;
            $result_return = $this->search_simple($object,$funct,$part,$param,$maxResults);
            return $result_return;
        }
    }

      protected function search_statistics($object, $funct, $part, $id_list) {
        if (!empty($this->youtube)) {
            $list = array_chunk($id_list, 50);
            $result = [];
            foreach ($list as $id_arr) {
                $id_string = implode(',', $id_arr);
                $param = array('id' => $id_string);
                $result_youtube = $this->search_simple($object, $funct, $part, $param);
                $result = array_merge($result, $result_youtube);
            }
            return $result;
        }
    }

    protected function search_video_statistics($id_video) {
        if (!empty($this->youtube)) {
            $object = $this->youtube->videos;
            $funct='listVideos';
            $part="snippet,statistics";
           return $this->search_statistics($object, $funct, $part, $id_video);
        }
    }
    
    protected function search_channel_statistics($id_channel) {
        if (!empty($this->youtube)) {
            $object = $this->youtube->channels;
            $funct='listChannels';
            $part="snippet,statistics,contentDetails";
           return $this->search_statistics($object, $funct, $part, $id_channel);
        }
    }

    protected function search_playlist_statistics($id_playlist) {
        if (!empty($this->youtube)) {
            $object = $this->youtube->playlists;
            $funct='listPlaylists';
            $part="snippet,contentDetails";
           return $this->search_statistics($object, $funct,$part, $id_playlist);
        }
    }

    protected function search_channel_by_idPlaylist($id_channel) {
        if (!empty($this->youtube)) {
            $param = array('channelId' => $id_channel);
            $result_youtube = $this->youtube->channelSections->listChannelSections("snippet,contentDetails", $param);
            return $result_youtube['items'];
        }
    }

}
