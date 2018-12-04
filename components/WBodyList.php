<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './WControlContent.php';

class WBodyListChannel extends WControlContent implements IStratCompCreate {

    public function create() {
      $this->get_data_from_BD();
      echo $this->create_list_channels();  
    }
    
    private function create_list_channels() {
    $result='<div class="list-group">';    
    foreach(WControlContent::$channels as $key=>$channel){
        $result.='<div class="list-group-item" id="'.$key.'">
			<div class="media">
                        <div class="media-body" >
			<div class="card">
			<div class="card-header">
			<h5>'.$channel['title'].'</h5>
			</div>
			<div class="card-body">
			<h6>'.$channel['description'].'</h6>
			</div></div></div>
			</div>
		</div>';  
      }
      $result.='</div>';
      return $result;
    }
}

class WBodyChannel extends WControlContent implements IStratCompCreate {

    public function create() {
     $this->get_data_from_BD();
     echo $this->create_list_playlists();   
    }
  
    private function create_list_playlists() {
    $result='<div class="list-group">';    
    foreach(WControlContent::$playlists as $key=>$playlist){
        $result.='<div class="list-group-item" id="'.$key.'">
			<div class="media">
                        <iframe id="bp_'.$key.'" type="text/html" width="320" height="180"
                                src="http://www.youtube.com/embed?listType=playlist&list='.$key.'"
                                frameborder="0" allowfullscreen> </iframe>
                        <div class="media-body" >
			<div class="card">
			<div class="card-header">
			<h5>'.$playlist['title'].'</h5>
			</div>
			<div class="card-body">
			<h6>'.$playlist['description'].'</h6>
			</div></div></div>
			</div>
		</div>';  
      }
      $result.='</div>';
      return $result;
    }
}

class WBodyPlaylist extends WControlContent implements IStratCompCreate {

    public function create() {
      $this->get_data_from_BD();
      echo $this->create_list_video();   
    }  
    
    private function create_list_video() {
    $result='<div class="list-group">';    
    foreach(WControlContent::$videos as $key=>$video){
        $result.='<div class="list-group-item" id="'.$key.'">
			<div class="media">
                        <iframe id="bv_'.$key.'" type="text/html" width="320" height="180"
                                src="http://www.youtube.com/embed/'.$key.'?rel=0&iv_load_policy=3&disablekb=1"
                                frameborder="0" allowfullscreen> </iframe>
                        <div class="media-body" >
			<div class="card">
			<div class="card-header">
			<h5>'.$video['title'].'</h5>
			</div>
			<div class="card-body">
			<h6>'.$video['description'].'</h6>
			</div></div></div>
			</div>
		</div>';  
      }
      $result.='</div>';
      return $result;
    }
}

class WBodyVideo extends WControlContent implements IStratCompCreate {

    public function create() {
      $this->create_video();  
    }  
    
       private function create_video() {
           $video=WControlContent::$videos[WControlContent::params['video']];
       ?>    
        <div class="card">
            <div class="card-img-top d-flex justify-content-center">
                <iframe id="ytplayer" type="text/html" width="640" height="360"
                        src="http://www.youtube.com/embed/<?php echo WControlContent::params['video'] ?>?rel=0&iv_load_policy=3&disablekb=1"
                        frameborder="0" allowfullscreen> </iframe>
            </div>
            <div class="card-header text-center">
                <h5><?php echo $video['title'] ?></h5>
            </div>
            <div class="card-body">
                <h6><?php echo $video['description'] ?></h6>
            </div>
        </div>
       <?php
    }
}