<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WBodyVideo extends WControlContent implements IStratCompCreate {

    public function update($param=null) {
       $this->create_video();  
    }

    private function create_video() {
        $video = parent::$videos[parent::$params['id_video']];
        $key_item=WControlContent::$params['id_item'];
        $key_channel=WControlContent::$params['id_channel'];
        $key_playlist=WControlContent::$params['id_playlist'];
        ?>    

        <div class="card bg-dark mx-auto" >
             <div class="card-img-top d-flex justify-content-center my-3 bg-dark">
                <iframe id="ytplayer" type="text/html" width="640" height="360"
                        src="http://www.youtube.com/embed/<?php echo parent::$params['id_video'] ?>?rel=0&iv_load_policy=3&disablekb=1"
                        frameborder="0" allowfullscreen> </iframe>
            </div>
            <div class="card-header text-center bg-secondary mx-3">
               
                <button id="inch_<?php echo $key_item ?>" type="button" class="btn btn-primary mx-2 channels">Каналы</button>
                <button id="inpl_<?php echo $key_channel ?>" type="button" class="btn btn-primary mx-2 playlists">Плейлисты</button>
                <button id="invd_<?php echo $key_playlist ?>" type="button" class="btn btn-primary mx-2 info-video">Видео</button>
                <h5><?php echo $video['title'] ?></h5>
            </div>
            <div class="card-body mx-3 bg-secondary">
                <h6><?php echo $video['description'] ?></h6>
            </div>
        </div>
        <?php
    }

}
