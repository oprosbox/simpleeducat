<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';


class WNav extends WControlContent implements IStratCompCreate {

    public function create() {
        ?>
        <div class="list-group">
        <div class="list-group-item"><?php echo $this->create_line_channels();?></div>
        <div class="list-group-item"><?php echo $this->create_line_playlists();?></div>
        <div class="list-group-item"><?php echo $this->create_line_videos();?></div>
        </div> 
        <?php
        }
/**
 * 
 * @return string
 */
    private function create_line_channels() {
    $result='<div class="list-unstyled media" style="overflow-x: auto">'; 
    foreach(parent::$channels as $key => $channel){
        $result.='<div class="col-3" id="ldiv_'.$key.'" height="90">
                    <div class="row">
                        <h6>'.$channel['title'].'</h6>
                </div>  
            </div>';  
      }
      $result.='</div>';
      return $result;
    }
/**
 * 
 * @return string
 */
    private function create_line_playlists() {
        $result='<div class="list-unstyled media" style="overflow-x: auto">'; 
    foreach (parent::$playlists as $key => $playlist) {
         $result.='<div class="col-3" id="ldiv_'.$key.'" height="90">
                    <div class="row">
                    <div class="col-6">  
                        <iframe id="lp_'.$key.'" type="text/html" width="160" height="90"
                                src="http://www.youtube.com/embed?listType=playlist&list='.$key.'?rel=0&iv_load_policy=3&disablekb=1"
                                frameborder="0" allowfullscreen> </iframe>
                    </div> 
                    <div class="col-6"> 
                        <h6>'.$playlist['title'].'</h6>
                    </div> 
                </div>  
            </div>';      
      } 
      $result.='</div>';
      return $result;
    }
/**
 * 
 * @return string
 */
    private function create_line_videos() {
        $result='<div class="list-unstyled media" style="overflow-x: auto">';
    foreach (parent::$videos as $key => $video) {
         $result.='<div class="col-3" id="ldiv_'.$key.'" height="90">
                    <div class="row">
                    <div class="col-6">  
                        <iframe id="lp_'.$key.'" type="text/html" width="160" height="90"
                                src="http://www.youtube.com/embed/'.$key.'?rel=0&iv_load_policy=3&disablekb=1"
                                frameborder="0" allowfullscreen> </iframe>
                    </div> 
                    <div class="col-6"> 
                        <h6>'.$video['title'].'</h6>
                    </div> 
                </div>  
            </div>';    
      }  
      $result.='</div>';
      return $result;
    }
    
    }
    