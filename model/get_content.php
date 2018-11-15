<?php



require_once 'interfaces.php';

class WYoutubeDataGetUser implements IYoutubeDataGetUser{
    public function data_list_content($id_item) {
        
    }

    public function menu() {
        
    }

}

class WYoutubeDataGetAdmin extends WYoutubeDataGetUser implements IYoutubeDataGetAdmin{
    
    public function data_lists_of_content(array $id_item) {
        
    }

    public function lists_of_content(array $id_list) {
        
    }

    public function menu_item(array $id_item) {
        
    }

    public function questions(array $id_question) {
        
    }

    public function youtube_chanel(array $id_chanels) {
        
    }

    public function youtube_play_list(array $id_play_lists) {
        
    }

    public function youtube_video(array $id_video) {
        
    }

}