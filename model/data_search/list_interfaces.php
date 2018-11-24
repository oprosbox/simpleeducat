<?php

require_once '/./search_interfaces.php';

class WContent {

    public $id_parent;
    public $type;
    public $id;
    public $title;
    public $description;
    public $statistics;

    public function get_id_parent() {
        return $this->id_parent;
    }

    public function set_id_parent($id_parent) {
        $this->id_parent = $id_parent;
        return $this;
    }

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

interface IStrategySave {

    public function save(WContent $content);
}

interface IStrategyView {

    public function leaf_view(&$body, $content);

    public function composite_view(&$body, $content);
}

interface ITreeContent {

    public function set_strat_view(IStrategyView $view_strat);

    public function set_strat_save(IStrategySave $save_strat);

    public function add($param);

    public function remove($id);

    public function get_content($id);

    public function view(&$body);

    public function save();
}

interface IRequest extends ITreeContent {

    public function set_strat_search(ISearch $search_strat);

    public function update_statistics();

    public function build_tree();
}
