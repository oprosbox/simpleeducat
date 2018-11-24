<?php

require_once 'interfaces.php';

class WYoutubeDataGetUser implements IYoutubeDataGetUser{
    
    public function data_list_content($id_item) {
        
    }

    public function menu() {
        
    }

}

class WYoutubeDataGetAdmin extends WYoutubeDataGetUser implements IYoutubeDataGetAdmin{
    
    public function lists_of_content($id_item) {
        
    }

    public function youtube_chanels($id_list) {
    
    }

    public function youtube_playlists($id_chanel) {
        
    }

    public function youtube_videos($id_playlist) {
        
    }

}