<?php

require_once '/./interfaces.php';
require_once '/./WBaseComponent.php';
require_once '/./../model/index.php';

class WControlContent {
    
    static public function create_from_session(){ 
    if(!empty($_SESSION['params'])){self::$params =$_SESSION['params'];}
    if(!empty($_SESSION['channels'])) {self::$channels=$_SESSION['channels'];}
    if(!empty($_SESSION['playlists'])) {self::$playlists=$_SESSION['playlists'];}
    if(!empty($_SESSION['videos'])) {self::$videos=$_SESSION['videos'];}}
            
    static public function update_to_session(){ 
    $_SESSION['params']=self::$params;
    $_SESSION['channels']=self::$channels;
    $_SESSION['playlists']=self::$playlists;
    $_SESSION['videos']=self::$videos;  
    }
    
    static public function get_params() {
        return self::$params;
    }

    static public function set_array($id_item, $id_channel, $id_playlist, $id_video) {
        self::$params['id_item'] = $id_item;
        self::$params['id_channel'] = $id_channel;
        self::$params['id_playlist'] = $id_playlist;
        self::$params['id_video'] = $id_video;
        self::update_to_session();
    }

    static public function get_data_from_BD() {
        if ((!empty(self::$params['id_item'])) && (empty(self::$params['id_channel']))) {
            self::get_data_from_BD_id_item();
            self::update_to_session();
            return;
        } else if ((!empty(self::$params['id_channel'])) && (empty(self::$params['id_playlist']))) {
            self::get_data_from_BD_id_channel();
            self::update_to_session();
            return;
        } else if ((!empty(self::$params['id_playlist'])) && (empty(self::$params['id_video']))) {
            self::get_data_from_BD_id_playlist();
            self::update_to_session();
            return;
        }
    }
    
    static public function get_channels_from_BD_next() {
        $pos = count(self::$channels);
        $channels = WBaseComponent::$strat_data_get->data_list_content(self::$params['id_item'], "youtube#channel", $pos, self::$step);
        if (empty($channels)) {
            return null;
        }
        self::$channels = array_merge(self::$channels, $channels);
        self::update_to_session();
        return true;
    }

    static public function get_playlists_from_BD_next() {
        $pos = count(self::$playlists);
        $playlists = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_channel'], "youtube#playlist", $pos, self::$step);
        if (empty($playlists)) {
            return null;
        }
        self::$playlists = array_merge(self::$playlists, $playlists);
        self::update_to_session();
        return true;
    }

    static public function get_videos_from_BD_next() {
        $pos = count(self::$videos);
        $videos = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_playlist'], "youtube#video", $pos, self::$step);
        if (empty($videos)) {
            return null;
        }
        self::$videos = array_merge(self::$videos, $videos);
        self::update_to_session();
        return true;
    }

    static public function set_params($params) {
        WBaseComponent::create(null);
        if ((!empty($params['id_item']))&&(empty($params['id_channel']))) {
            self::$params['id_item']=$params['id_item'];
            self::$params['id_channel']=null;
            self::$params['id_playlist']=null;
            self::$params['id_video']=null;
        } 
        if ((!empty($params['id_channel']))&&(empty($params['id_playlist']))) {
            self::$params['id_channel']=$params['id_channel'];
            self::$params['id_playlist']=null;
            self::$params['id_video']=null;
        } 
        if ((!empty($params['id_playlist']))&&(empty($params['id_video']))) {
            self::$params['id_playlist']=$params['id_playlist'];
            self::$params['id_video']=null;
        } 
        if(!empty($params['id_video']))
        {   self::$params['id_video']=$params['id_video'];
        self::update_to_session();
            return;
        }
        self::get_data_from_BD();
    }

    static protected function get_data_id_item() {
        
        self::$channels = WBaseComponent::$strat_data_get->data_list_content(self::$params['id_item'], "youtube#channel", 0, self::$step);
        $key = array_keys(array_slice(self::$channels, 0, 1));
        self::$params['id_channel'] = $key[0];
    }

    static protected function get_data_id_channel() {
        self::$playlists = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_channel'], "youtube#playlist", 0, self::$step);
        $key = array_keys(array_slice(self::$playlists, 0, 1));
        self::$params['id_playlist'] = $key[0];
    }

    static protected function get_data_id_playlist() {
        self::$videos = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_playlist'], "youtube#video", 0, self::$step);
        $key = array_keys(array_slice(self::$videos, 0, 1));
        self::$params['id_video'] = $key[0];
    }

    static protected function get_data_from_BD_id_item() {
        self::get_data_id_item();
        self::get_data_id_channel();
        self::get_data_id_playlist();
    }

    static protected function get_data_from_BD_id_channel() {
        self::get_data_id_channel();
        self::get_data_id_playlist();
    }

    static protected function get_data_from_BD_id_playlist() {
        self::get_data_id_playlist();
    }
    public static function get_sz_update() {
        return self::$sz_update;
    }

    public static function set_sz_update($sz_update) {
        self::$sz_update = $sz_update;
        return self;
    }

    static protected $params = array('id_item' => null, 'id_channel' => null, 'id_playlist' => null, 'id_video' => null);
    static protected $channels;
    static protected $playlists;
    static protected $videos;
    static protected $step = 10;

}


