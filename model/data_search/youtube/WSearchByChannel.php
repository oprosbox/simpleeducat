<?php

require_once 'WSearch_base.php';

class WSearchByChannel implements IStratSearch {

    protected $list;
    protected $search_base;

    public function set_search_base(ISearch $search_base) {
        $this->search_base = $search_base;
        return $this;
    }

    public function search_content($keyword) {
        $this->list = $this->search_base->search_by_keyword($keyword,"youtube#channel");
        $this->list->build_tree($this->search_base);
    }

    public function get_view() {
        $view='';
        $this->list->view($view);
        if($view==''){$view="not found";}
        //else{$view="<table border=\"1\">$view</table>";}
        return $view;
    }

}
