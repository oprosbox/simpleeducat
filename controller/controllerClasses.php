<?php

require_once 'get_post.php';
require_once '/./../components/index.php';

class WGetParam implements WFunct {

    public function get_param() {
        return $this->param;
    }

    public $param;

    public function operation($value) {
        $this->param = $value;
    }

}

class WSetContent implements WFunct {

    public $funct;
    public $id;
    protected $params;

    public function __construct() {
        $this->funct = new WGetParam;
        $this->id = new WGetParam;
    }

    public function set_channel($id){
    $this->params['id_channel']=$id;
    }

    public function set_playlist($id){
    $this->params['id_playlist']=$id;
    }
    
    public function set_video($id){
    $this->params['id_video']=$id;   
    }
    
    public function set_item_menu($id){
    $this->params['id_item']=$id; 
    }
    
    public function operation($value) {
      $funct=$this->funct->get_param();
      $this->$funct($this->id->get_param()); 
      WControlContent::set_params($this->params); 
    }
}

class WUpdatePage implements WFunct {

    public $funct;
    public $position;
    
    public function __construct() {
        $this->funct = new WGetParam;
        $this->position= new WGetParam;
    }

    public function update_line_channels($count){
     CComponent::update('WNavChannels', $count);  
    }

    public function update_line_playlists($count){
     CComponent::update('WNavPlaylists', $count);    
    }
    
    public function update_line_videos($count){
     CComponent::update('WNavVideos', $count);    
    }
    
    public function update_page_channels($count){
      CComponent::update('WBodyListChannel', $count);   
    }

    public function update_page_playlists($count){
      CComponent::update('WBodyChannel', $count);   
    }
    
    public function update_page_videos($count){
      CComponent::update('WBodyPlaylist', $count);   
    }
    
     public function update_page_video($count){
      CComponent::update('WBodyVideo', $count);   
    }
    
    public function operation($value) {
      $funct=$this->funct->get_param();
      $this->$funct($this->position->get_param()); 
    }
}