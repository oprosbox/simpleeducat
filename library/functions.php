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

class WSearch extends YoutubeObject{

    public function get_results($parts,array $params){
        if (!empty($this->youtube)) {
         return $this->youtube->search->listSearch($parts, $params);   
        } 
    }
    
        public function get_video_list($parts,array $params){
        if (!empty($this->youtube)) {
         return $this->youtube->playlists->listPlaylists($parts, $params);   
        } 
    }
    
}

