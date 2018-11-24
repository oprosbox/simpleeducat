<?php

require_once '/./WListContent.php';

class WCompositeRequest extends WCompositeContent implements IRequest {
    static public $search_obj;
 

     static public function set_strat_search(ISearch $strat_search) {
        $this->search_obj = $search_strat;
        return this;
    }

    public function update_statistics() {
        $this->search_obj->get_statistics($this);
        foreach ($this->content as $value) {
            $value->update_statistics();
        }
    }

    public function build_tree() {
        $this->search_obj->get_statistics($this);
        foreach ($this->content as $key => $value) {
            $tree_youtube = null;
            set_time_limit(300);
            $tree_youtube = $this->search_obj->search($value);          
            if ($tree_youtube !== null) {
                $this->content[$key] = $tree_youtube;
                $this->content[$key]->build_tree();
            }
        }
    }

}

class WLeafRequest extends WLeafContent implements IRequest {
    
    static public $search_obj;

    static public function set_strat_search(ISearch $strat_search) {
        $this->search_obj = $search_strat;
        return this;
    }

    public function update_statistics() {
        $this->search_obj->get_statistics($this);
    }

    public function build_tree() {
        $this->search_obj->get_statistics($this);
    }

}
