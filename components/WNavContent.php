<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WNav extends WControlContent implements IStratCompCreate {

    public function update($param) {
        switch ($param) {
            case 'nav#channels': {
                    parent::get_channels_from_BD_next();
                    $this->update_channels();
                    break;
                }
            case 'nav#playlists': {
                    parent::get_playlists_from_BD_next();
                    $this->update_playlists();
                    break;
                }
            case 'nav#videos': {
                    parent::get_videos_from_BD_next();
                    $this->update_videos();
                }
        }
    }

    public function create() {
        ?>
        <div class="list-group">
            <div class="list-group-item"><?php $this->create_line_channels(); ?></div>
            <div class="list-group-item"><?php $this->create_line_playlists(); ?></div>
            <div class="list-group-item"><?php $this->create_line_videos(); ?></div>
        </div> 
        <?php
    }

    private function line_channels($key, $channel) {
        ?>   
        <div class="col-3" id="ldiv_<?php echo $key ?>" height="90">
            <div class="row">
                <h6><?php echo $channel['title'] ?></h6>
            </div>  
        </div>  
        <?php
    }

    private function line_playlists($key, $playlist) {
        ?>  
        <div class="col-3" id="ldiv_<?php echo $key ?> " height="90">
            <div class="row">
                <div class="col-6">  
                    <iframe id="lp_<?php echo $key ?> " type="text/html" width="160" height="90"
                            src="http://www.youtube.com/embed?listType=playlist&list=<?php echo $key ?> ?rel=0&iv_load_policy=3&disablekb=1"
                            frameborder="0" allowfullscreen> </iframe>
                </div> 
                <div class="col-6"> 
                    <h6><?php echo $playlist['title'] ?> </h6>
                </div> 
            </div>  
        </div>      
        <?php
    }

    private function line_videos($key, $video) {
        ?> 
        <div class="col-3" id="ldiv_<?php echo $key ?> " height="90">
            <div class="row">
                <div class="col-6">  
                    <iframe id="lp_<?php echo $key ?>" type="text/html" width="160" height="90"
                            src="http://www.youtube.com/embed/<?php echo $key ?> ?rel=0&iv_load_policy=3&disablekb=1"
                            frameborder="0" allowfullscreen> </iframe>
                </div> 
                <div class="col-6"> 
                    <h6><?php echo $video['title'] ?> </h6>
                </div> 
            </div>  
        </div>
        <?php
    }

    private function create_line_channels() {
        echo '<div class="list-unstyled media" style="overflow-x: auto">';
        foreach (parent::$channels as $key => $channel) {
            $this->line_channels($key, $channel);
        }
        echo '</div>';
    }

    private function create_line_playlists() {
        echo '<div class="list-unstyled media" style="overflow-x: auto">';
        foreach (parent::$playlists as $key => $playlist) {
            $this->line_playlists($key, $playlist);
        }
        echo '</div>';
    }

    private function create_line_videos() {
        echo '<div class="list-unstyled media" style="overflow-x: auto">';
        foreach (parent::$videos as $key => $video) {
            $this->line_videos($key, $video);
        }
        echo '</div>';
    }

    public function update_videos() {
        $array = array_slice(WControlContent::$videos, -WControlContent::$sz_update, WControlContent::$sz_update, true);
        foreach ($array as $key => $video)
            $this->line_videos($key, $video);
    }

    public function update_playlists() {
        $array = array_slice(WControlContent::$playlists, -WControlContent::$sz_update, WControlContent::$sz_update, true);
        foreach ($array as $key => $playlist)
            $this->line_playlist($key, $playlist);
    }

    public function update_channels() {
        $array = array_slice(WControlContent::$channels, -WControlContent::$sz_update, WControlContent::$sz_update, true);
        foreach ($array as $key => $channel)
            $this->line_channels($key, $channel);
    }

}
