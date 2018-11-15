<?php

require_once '/../vendor/autoload.php';

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

class WSearch extends YoutubeObject {

    public function search($question, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array("maxResults" => "$maxResults",
                "videoDuration" => "long",
                "q" => "$question");
            $result_youtube=$this->youtube->search->listSearch("id,snippet", $param);
            $result=array();
            foreach ($result_youtube['items'] as $resource) {
                array_push($result, $resource);  
            }
            return $result;
        }
    }

    public function search_by_idPlayList($playlistId, $maxResults = 50) {
        if (!empty($this->youtube)) {
            $param = array('maxResults' => "$maxResults",
                'playlistId' => "$playlistId");
            $result_youtube = $this->youtube->playlistItems->listPlaylistItems("snippet,contentDetails", $param);
            $result = array();
            foreach ($result_youtube['items'] as $resource) {
                array_push($result, $resource);
            }
            return $result;
        }
    }

    public function search_by_idChanel($id_chanel) {
        if (!empty($this->youtube)) {
            $param = array('maxResults' => "$maxResults",
                'id' => "$id_chanel");
            $result_youtube = $this->youtube->channelSections->listChannelSections("snippet,contentDetails", $param);
            $result = array();
            foreach ($result_youtube['items'] as $resource) {
                array_push($result, $resource);
            }
            return $result;
        }
    }
    
     public function search_video_by_idChanel($id_chanel) {
           if (!empty($this->youtube)) {
            $param = array('maxResults' => "$maxResults",
                'id' => "$id_chanel");
            $result_youtube = $this->youtube->channelSections->listChannelSections("snippet,contentDetails", $param);
            $arrayVideo=array();
            foreach ($result_youtube['items'] as $resource) {
                $contentDetails=$resource['contentDetails']; 
                 foreach ($contentDetails->playlists as $id_playlists){
                     array_push($arrayVideo, $id_playlist);  
                 }
                 foreach ($contentDetails->channels as $id_chanel){
                     array_push($arrayVideo, search_video_by_idChanel($id_chanel));  
                 }
            }
            return $arrayVideo;
        }  
     }
     
}