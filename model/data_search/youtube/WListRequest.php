<?php

require_once '/./WListContent.php';

class WLeafRequest extends WLeafContent implements IRequest {
    
    static public $search_obj;

    static public function set_strat_search(ISearch $strat_search) {
        self::$search_obj = $strat_search;
    }

    public function update_statistics() {
    }

    public function build_tree() {
    }

}

class WCompositeRequest extends WCompositeContent implements IRequest {

    static public $search_obj;

    static public function set_strat_search(ISearch $strat_search) {
        self::$search_obj = $strat_search;
        WLeafRequest::$search_obj = $strat_search;
    }

    public function update_statistics() {
        self::$search_obj->get_statistics($this->content);
        foreach ($this->content as $value) {
            $value->update_statistics();
        }
    }

    public function build_tree() {
        set_time_limit(300);
        $this->content = self::$search_obj->search($this);
        self::$search_obj->get_statistics($this->content);
        foreach ($this->content as $value) {
            $value->build_tree();
        }
    }

}
