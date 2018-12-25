<?php

require_once 'commands.php';

//-----------------------------------------------------------------------------------
class WFunctExample implements WFunct {

    public function get_name_post() {
        return $this->name;
    }

    public function get_error_description() {
        return $this->error_description;
    }

    public function set_name_post($name) {
        $this->name = $name;
        return $this;
    }

    public function set_error_description($error_description) {
        $this->error_description = $error_description;
        return $this;
    }

    protected $name;
    protected $error_description;

    public function operation($value) {
        //дописывается для каждого пост запроса отдельно
    }
}

class WPostList extends WCommandList {//обработка POST запросов

    public function release_commands(...$name_post) {
          foreach ($name_post as $name)
            if (empty($_POST[$name])) {
               return false;
            }
        foreach ($name_post as $name)
            if (!empty($_POST[$name])) {
                parent::start($name, $_POST[$name]);
            }
            return true;
    }

}

class WGetList extends WCommandlist {//обработка GET запросов

    public function release_commands(...$name_get) {
        foreach ($name_get as $name)
            if (empty($_GET[$name])) {
                return false;
            }
        foreach ($name_get as $name)
            if (!empty($_GET[$name])) {
                parent::start($name, $_GET[$name]);
            }
        return true;
    }

}
