<?php

require_once 'get_post.php';

class WGetParam extends WFunct {

    public function get_param() {
        return $this->param;
    }

    public $param;

    public function operation($value) {
        $this->param = $value;
    }

}

class WCreatePage extends WFunct {

    public $type;
    public $id;

    public function __construct() {
        $this->type = new WGetParam;
        $this->id = new WGetParam;
    }

    public function operation($value) {
        switch ($this->type->get_param()) {
            case 'set#channels': {
                    WBody::set_id_item($this->id->get_param());
                    break;
                }
            case 'set#playlists': {
                    WBody::set_id_channel($this->id->get_param());
                    break;
                }
            case 'set#videos': {
                    WBody::set_id_playlist($this->id->get_param());
                    break;
                }
            case 'set#video': {
                    WBody::set_id_video($this->id->get_param());
                    break;
                }
        }
    }
}

class WUpdatePage extends WFunct {

    public $type;
    public $count;
    public function __construct() {
        $this->type = new WGetParam;
        $this->count= new WGetParam;
    }

    public function operation($value) {
        WBody::set_count($this->count->get_param());
        switch ($this->type->get_param()) {
            case 'list#channels': {
                    WBody::update_list_channels();
                    break;
                }
            case 'list#playlists': {
                    WBody::update_list_playlists();
                    break;
                }
            case 'list#videos': {
                    WBody::update_list_videos();
                    break;
                }
            case 'nav#channels':
            case 'nav#playlists':
            case 'nav#videos': {
                    WBody::update_nav($this->type->get_param());
                }
        }
    }
}