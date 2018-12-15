<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WBodyListChannel extends WControlContent implements IStratCompCreate {

    public function update($param=null) {
        WControlContent::get_channels_from_BD_next();
        $array = array_slice(WControlContent::$channels, -WControlContent::$sz_update, WControlContent::$sz_update, true);
        foreach ($array as $key => $channel)
            $this->list_channels($key, $channel);
    }

    public function create() {
        echo '<div class="list-group">';
        foreach (WControlContent::$channels as $key => $channel) {
            $this->list_channels($key, $channel);
        }
        echo '</div>';
    }

    private function list_channels($key, $channel) {
        ?>
        <div class="list-group-item" id="<?php echo $key ?>">
            <div class="media">
                <div class="media-body" >
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $channel['title'] ?></h5>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $channel['description'] ?></h6>
                        </div></div></div>
            </div>
        </div>;  
        <?php
    }

}

class WBodyChannel extends WControlContent implements IStratCompCreate {

    public function update($param=null) {
        WControlContent::get_playlists_from_BD_next();
        $array = array_slice(WControlContent::$playlists, -WControlContent::$sz_update, WControlContent::$sz_update, true);
        foreach ($array as $key => $playlist)
            $this->item_playlist($key, $playlist);
    }

    public function create() {
        echo '<div class="list-group">';
        foreach (WControlContent::$playlists as $key => $playlist) {
            $this->item_playlist($key, $playlist);
        }
        echo '</div>';
    }

    private function item_playlist($key, $playlist) {
        ?> <div class="list-group-item" id="<?php echo $key ?>">
            <div class="media">
                <iframe id="bp_<?php echo $key ?>" type="text/html" width="320" height="180"
                        src="http://www.youtube.com/embed?listType=playlist&list=<?php echo $key ?>"
                        frameborder="0" allowfullscreen> </iframe>
                <div class="media-body" >
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $playlist['title'] ?></h5>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $playlist['description'] ?></h6>
                        </div></div></div>
            </div>
        </div> 
        <?php
    }

}

class WBodyPlaylist extends WControlContent implements IStratCompCreate {

    public function update($param=null) {
        WControlContent::get_videos_from_BD_next();
        $array = array_slice(WControlContent::$videos, -WControlContent::$sz_update, WControlContent::$sz_update, true);
        foreach ($array as $key => $video)
            $this->item_video($key, $video);
    }

    public function create() {
        echo '<div class="list-group">';
        foreach (WControlContent::$videos as $key => $video) {
            $this->item_video($key, $video);
        }
        echo '</div>';
    }

    private function item_video($key, $video) {
        ?> <div class="list-group-item" id="<?php echo $key ?>">
            <div class="media">
                <iframe id="bv_<?php echo $key ?>" type="text/html" width="320" height="180"
                        src="http://www.youtube.com/embed/<?php echo $key ?>?rel=0&iv_load_policy=3&disablekb=1"
                        frameborder="0" allowfullscreen> </iframe>
                <div class="media-body" >
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $video['title'] ?></h5>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $video['description'] ?></h6>
                        </div></div></div>
            </div>
        </div> 
        <?php
    }

}

class WBodyVideo extends WControlContent implements IStratCompCreate {

    public function update($param=null) {
        
    }

    public function create() {
        $this->create_video();
    }

    private function create_video() {
        $video = parent::$videos[parent::$params['id_video']];
        ?>    
        <div class="card">
            <div class="card-img-top d-flex justify-content-center">
                <iframe id="ytplayer" type="text/html" width="640" height="360"
                        src="http://www.youtube.com/embed/<?php echo parent::$params['id_video'] ?>?rel=0&iv_load_policy=3&disablekb=1"
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
