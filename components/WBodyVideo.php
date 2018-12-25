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
        ?>    
        <div class="card bg-dark mx-auto" style="max-width: 1200px;">
            <div class="card-img-top d-flex justify-content-center my-3 bg-dark">
                <iframe id="ytplayer" type="text/html" width="640" height="360"
                        src="http://www.youtube.com/embed/<?php echo parent::$params['id_video'] ?>?rel=0&iv_load_policy=3&disablekb=1"
                        frameborder="0" allowfullscreen> </iframe>
            </div>
            <div class="card-header text-center m-3 bg-secondary">
                <h5><?php echo $video['title'] ?></h5>
            </div>
            <div class="card-body mx-3 bg-secondary">
                <h6><?php echo $video['description'] ?></h6>
            </div>
        </div>
        <?php
    }

}
