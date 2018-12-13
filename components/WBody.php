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
        parent::set_params(array('id_video'=>$id_item)); 
        CComponent::create('WBodyVideo');
    }
}