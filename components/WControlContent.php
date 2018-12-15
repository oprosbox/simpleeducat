<?php

require_once '/./interfaces.php';
require_once '/./WBaseComponent.php';
require_once '/./../model/index.php';

class WControlContent {

    static public function get_params() {
        return self::$params;
    }

    static public function set_array($id_item, $id_channel, $id_playlist, $id_video) {
        self::$params['id_item'] = $id_item;
        self::$params['id_channel'] = $id_channel;
        self::$params['id_playlist'] = $id_playlist;
        self::$params['id_video'] = $id_video;
    }

    static public function get_data_from_BD() {
        if ((!empty(self::$params['id_item'])) && (empty(self::$params['id_channel']))) {
            self::get_data_from_BD_id_item();
            return;
        } else if ((!empty(self::$params['id_channel'])) && (empty(self::$params['id_playlist']))) {
            self::get_data_from_BD_id_channel();
            return;
        } else if ((!empty(self::$params['id_playlist'])) && (empty(self::$params['id_video']))) {
            self::get_data_from_BD_id_playlist();
            return;
        }
    }
    
    static public function get_channels_from_BD_next() {
        $pos = count(self::$channels);
        $channels = WBaseComponent::$strat_data_get->data_list_content(self::$params['id_item'], "youtube#channel", $pos, self::$step);
        if (empty($channels)) {
            self::$sz_update =0;
            return null;
        }
        self::$channels = array_merge(self::$channels, $channels);
        self::$sz_update= count($channels);
        return self::$sz_update;
    }

    static public function get_playlists_from_BD_next() {
        $pos = count(self::$playlists);
        $playlists = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_channel'], "youtube#playlist", $pos, self::$step);
        if (empty($playlists)) {
            self::$sz_update =0;
            return null;
        }
        self::$playlists = array_merge(self::$playlists, $playlists);
        self::$sz_update = count($playlists);
        return self::$sz_update;
    }

    static public function get_videos_from_BD_next() {
        $pos = count(self::$videos);
        $videos = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_playlist'], "youtube#video", $pos, self::$step);
        if (empty($videos)) {
            self::$sz_update =0;
            return null;
        }
        self::$videos = array_merge(self::$videos, $videos);
        self::$sz_update = count($videos);
        return self::$sz_update;
    }

    static public function set_params($params) {
        WBaseComponent::create(null);
        if (empty($params['id_item'])) {
            self::set_array(null, null, null, null);
        } else if (empty($params['id_channel'])) {
            self::set_array($params['id_item'], null, null, null);
        } else if (empty($params['id_playlist'])) {
            self::set_array($params['id_item'], $params['id_channel'], null, null);
        } else if (empty($params['id_video'])) {
            self::set_array($params['id_item'], $params['id_channel'], $params['id_playlist'], null);
        } else {
            self::set_array($params['id_item'], $params['id_channel'], $params['id_playlist'], $params['id_video']);
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
    static protected $sz_update = 0;
    static protected $channels;
    static protected $playlists;
    static protected $videos;
    static protected $step = 10;

}
