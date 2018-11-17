<?php

require_once '/./../../library/vendor/autoload.php';

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


abstract class WAbstractSearch extends YoutubeObject {

    private function search_by_question($param, $maxResults = 0) {
        $result_return = array();
        if ($maxResults === 0) {
            $param['maxResults'] = 50;
            do {
                $result_question = $this->youtube->search->listSearch("id,snippet", $param);
                $param['pageToken'] = $result_question['nextPageToken'];
                foreach ($result_question['items'] as $resource)
                    $result_return[] = $resource;
            } while ($result_question['nextPageToken'] !== null);
        } else {
            $result_question = $this->youtube->search->listSearch("id,snippet", $param);
            $result_return[] = $result_question['items'];
        }
        return $result_return;
    }

    protected function search_video($question, $duration = 'long', $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array("maxResults" => $maxResults,
                "videoDuration" => $duration,
                "q" => $question,
                "type" => "video");
            $result_return = array();
            $result_return = $this->search_by_question($param, $maxResults);
            return $result_return;
        }
    }

    protected function search_chanel($question, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array("maxResults" => $maxResults,
                "q" => $question,
                "type" => "channel");
            $result_return = array();
            $result_return = $this->search_by_question($param, $maxResults);
        }
        return $result_return;
    }

    protected function search_playlist($question, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array("maxResults" => $maxResults,
                "pageToken" => '',
                "q" => $question,
                "type" => "playlist");
            $result_return = array();
            $result_return = $this->search_by_question($param, $maxResults);
            return $result_return;
        }
    }

    protected function search_video_by_idPlayList($playlistId, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array('maxResults' => $maxResults,
                'playlistId' => $playlistId);
            $result_return = array();
            if ($maxResults === 0) {
                $param['maxResults'] = 50;
                do {
                    $result_question = $this->youtube->playlistItems->listPlaylistItems("snippet,contentDetails", $param);
                    $param['pageToken'] = $result_question['nextPageToken'];
                    foreach ($result_question['items'] as $resource)
                        $result_return[] = $resource;
                } while ($result_question['nextPageToken'] !== null);
            } else {
                $result_question = $this->youtube->playlistItems->listPlaylistItems("snippet,contentDetails", $param);
                $result_return[] = $result_question['items'];
            }
            return $result_return;
        }
    }

    protected function search_playList_by_idVideo($id_video, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array('maxResults' => $maxResults,
                'videoId' => $id_video);
            $result_return = array();
            if ($maxResults === 0) {
                $param['maxResults'] = 50;
                do {
                    $result_question = $this->youtube->playlistItems->listPlaylistItems("snippet,playlistId", $param);
                    $param['pageToken'] = $result_question['nextPageToken'];
                    foreach ($result_question['items'] as $resource)
                        $result_return[] = $resource;
                } while ($result_question['nextPageToken'] !== null);
            } else {
                $result_question = $this->youtube->playlistItems->listPlaylistItems("snippet,playlistId", $param);
                $result_return[] = $result_question['items'];
            }
            return $result_return;
        }
    }

    protected function search_lists_by_idChanel($id_chanel, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array('maxResults' => $maxResults,
                'channelId' => $id_chanel);
            $result_return = array();
            if ($maxResults === 0) {
                $param['maxResults'] = 50;
                do {
                    $result_question = $this->youtube->playlists->listPlaylists("id,snippet", $param);
                    $param['pageToken'] = $result_question['nextPageToken'];
                    foreach ($result_question['items'] as $resource)
                        $result_return[] = $resource;
                } while ($result_question['nextPageToken'] !== null);
            } else {
                $result_question = $this->youtube->playlistItems->listPlaylist("id,snippet", $param);
                $result_return[] = $result_question['items'];
            }
            return $result_return;
        }
    }

    protected function search_video_statistics($id_video, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array('maxResults' => $maxResults,
                'id' => $id_video);
            $result_youtube = $this->youtube->videos->listVideos("snippet,statistics,contentDetails", $param);
            return $result_youtube['items'];
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
