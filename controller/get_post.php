<?php

require_once 'commands.php';

//-----------------------------------------------------------------------------------
class WFunct_Post implements WFunct {    
    public function get_name_post() {
        return $this->name_post;
    }

    public function get_error_description() {
        return $this->error_description;
    }

    public function set_name_post($name_post) {
        $this->name_post = $name_post;
        return $this;
    }

    public function set_error_description($error_description) {
        $this->error_description = $error_description;
        return $this;
    }

    protected $name_post;
    protected $error_description;

    public function __construct() {
        
    }

    public function operation($value) {
        //дописывается для каждого пост запроса отдельно
    }

}

class WPost_list extends WCommand_List {//обработка POST запросов

    public function release_commands(...$name_post) {
        foreach ($name_post as $name)
            if (!empty($_POST[$name])) {
                parent::start($name, $_POST[$name]);
            }
    }

}

class WGet_list extends WCommand_list {//обработка GET запросов

    public function release_commands(...$name_get) {
        foreach ($name_get as $name)
            if (!empty($_GET[$name])) {
                parent::start($name, $_GET[$name]);
            }
    }

}

class WPost_message extends WCommand_Message {//обработка POST запросов по результатам

    public function release_commands(...$name_post) {
        foreach ($name_post as $name)
            if (!empty($_POST[$name])) {
                parent::start($_POST[$name], $_POST[$name]);
            }
    }

}

class WGet_message extends WCommand_Message {//обработка GET запросов по результатам

    public function release_commands(...$name_post) {
        foreach ($name_post as $name)
            if (!empty($_GET[$name])) {
                parent::start($_GET[$name], $_GET[$name]);
            }
    }

}
