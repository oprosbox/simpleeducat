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
            case 'channels': {
                    WBody::set_id_item($this->id->get_param());
                    break;
                }
            case 'playlist': {
                    WBody::set_id_channel($this->id->get_param());
                    break;
                }
            case 'videos': {
                    WBody::set_id_playlist($this->id->get_param());
                    break;
                }
            case 'video': {
                    WBody::set_id_video($this->id->get_param());
                    break;
                }
        }
    }
}
