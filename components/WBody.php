<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./bodyComponents.php';

class WBody extends WControlContent{
       
    static public function set_id_item($id_item) {
        parent::set_params(array('id_item'=>$id_item));
        CComponent::create('WNav');
        CComponent::create('WBodyListChannel');
    }

    static public function set_id_channel($id_item) {
     parent::set_params(array('id_channel'=>$id_item,
                              'id_playlist'=>null,
                              'id_video'=>null));
     CComponent::create('WNav');
     CComponent::create('WBodyChannel');
    }

    static public function set_id_playlist($id_item) {
       parent::set_params(array('id_playlist'=>$id_item,
                                'id_video'=>null)); 
        CComponent::create('WNav');
        CComponent::create('WBodyPlaylist');
    }

    static public function set_id_video($id_item) {
        parent::set_params(array('id_video' => $id_item));
        CComponent::create('WBodyVideo');
    }

    static public function update_list_channels() {
        CComponent::update('WBodyListChannel',null);
    }

    static public function update_list_playlists() {
        CComponent::update('WBodyChannel',null);
    }

    static public function update_list_videos() {
        CComponent::update('WBodyPlaylist',null);
    }

    static public function update_nav($param) {
        CComponent::update('WNav',$param);
    }

    public static function set_count($count) {
        self::set_sz_update($count) ;
        return self;
    }


}