<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./interfaces.php';
require_once '/./../model/index.php';


class WControlContent{
    static public function get_params() {
        return self::$params;
    }

    static public function set_params($params) {
        if (empty($params['id_item'])) {
            self::$params['id_item'] = null;
            self::$params['id_channel'] = null;
            self::$params['id_playlist'] = null;
            self::$params['id_video'] = null;
            return;
        }
        if (empty($params['id_channel'])) {
            self::$params['id_item']=$params['id_item'];
            self::$params['id_channel'] = null;
            self::$params['id_playlist'] = null;
            self::$params['id_video'] = null;
            return;
        }
        if (empty($params['id_playlist'])) {
            self::$params['id_item']=$params['id_item'];
            self::$params['id_channel']=$params['id_channel'];
            self::$params['id_playlist'] = null;
            self::$params['id_video'] = null;
            return;
        }
        if (empty($params['id_video'])) {
            self::$params['id_item']=$params['id_item'];
            self::$params['id_channel']=$params['id_channel'];
            self::$params['id_playlist'] =$params['id_playlist'];
            self::$params['id_video'] = null;
            return;
        }
        self::$params = $params;
    }

    protected function get_data_from_BD() {
        
        if (self::$params['id_channel'] == null) {
            self::$channels = WBaseComponent::$strat_data_get->data_list_content(self::$params['id_item'], "youtube#channel");
        }
        if ((!empty(self::$channels)) && (self::$params['id_channel'] == null)) {
            $key = array_keys(array_slice(self::$channels, 0, 1));
            self::$params['id_channel'] = $key[0];
        }
        if (self::$params['id_playlist'] == null) {
            self::$playlists = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_channel'], "youtube#playlist");
        }
        if ((!empty(self::$playlists)) && (self::$params['id_playlist'] == null)) {
            $key = array_keys(array_slice(self::$playlists, 0, 1));
            self::$params['id_playlist'] = $key[0];
        }
        if (self::$params['id_video'] == null) {
            self::$videos = WBaseComponent::$strat_data_get->sources_by_parent(self::$params['id_playlist'], "youtube#video");
        }
        if ((!empty(self::$videos)) && (self::$params['id_video'] == null)) {
            $key = array_keys(array_slice(self::$videos, 0, 1));
            self::$params['id_video'] = $key[0];
        }}

    static protected $params=array('id_item'=>null,'id_channel'=>null,'id_playlist'=>null,'id_video'=>null);
    static protected $channels;
    static protected $playlists;
    static protected $videos; 
}

