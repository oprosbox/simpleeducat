<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WBodyListChannel extends WControlContent implements IStratCompCreate {

    public function add_next() {
        $this->add_list_channels();
    }

    public function create() {
        $this->create_list_channels();
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

    private function create_list_channels() {
        echo '<div class="list-group">';
        foreach (WControlContent::$channels as $key => $channel) {
            $this->list_channels($key, $channel);
        }
        echo '</div>';
    }

    private function add_list_channels() {
        $array = array_slice(WControlContent::$channels, -WControlContent::$sz_read['id_channel'], WControlContent::$sz_read['id_channel'], true);
        foreach ($array as $key => $channel) {
            $this->list_channels($key, $channel);
        }
    }

}

class WBodyChannel extends WControlContent implements IStratCompCreate {

    public function add_next() {
        $this->add_list_playlists();
    }

    public function create() {
        $this->create_list_playlists();
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

    private function create_list_playlists() {
        echo '<div class="list-group">';
        foreach (WControlContent::$playlists as $key => $playlist) {
            $this->item_playlist($key, $playlist);
        }
        echo '</div>';
    }

    private function add_list_playlists() {
        $array = array_slice(WControlContent::$playlists, -WControlContent::$sz_read['id_playlist'], WControlContent::$sz_read['id_playlist'], true);
        foreach ($array as $key => $playlist) {
            $this->item_playlist($key, $playlist);
        }
    }

}

class WBodyPlaylist extends WControlContent implements IStratCompCreate {

    public function add_next() {
        $this->add_list_video();
    }

    public function create() {
        $this->create_list_video();
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

    private function create_list_video() {
        echo '<div class="list-group">';
        foreach (WControlContent::$videos as $key => $video) {
            $this->item_video($key, $video);
        }
        echo '</div>';
    }

    private function add_list_video() {
        $array = array_slice(WControlContent::$videos, -WControlContent::$sz_read['id_video'], WControlContent::$sz_read['id_video'], true);
        foreach ($array as $key => $video) {
            $this->item_video($key, $video);
        }
    }

}

class WBodyVideo extends WControlContent implements IStratCompCreate {

    public function add_next() {
        
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
