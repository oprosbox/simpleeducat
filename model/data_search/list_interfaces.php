<?php

class WContent {

    public $type;
    public $id;
    public $title;
    public $description;
    public $statistics;
    
    
    public function get_type() {
        return $this->type;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_statistics() {
        return $this->statistics;
    }

    public function set_type($type) {
        $this->type = $type;
        return $this;
    }

    public function set_id($id) {
        $this->id = $id;
        return $this;
    }

    public function set_title($title) {
        $this->title = $title;
        return $this;
    }

    public function set_description($description) {
        $this->description = $description;
        return $this;
    }

    public function set_statistics($statistics) {
        $this->statistics = $statistics;
        return $this;
    }


}

interface ITreeContent {

    public function add($param);

    public function remove($id);

    public function get_content($id);
}

interface IRequest extends ITreeContent {

    public function update_statistics(&$search_obj);

    public function build_tree(&$search_obj);
    
    public function find_parent(&$search_obj);
    
    public function find_granny(&$search_obj);

    public function view(&$body);
}
