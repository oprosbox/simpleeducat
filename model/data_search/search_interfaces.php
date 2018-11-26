<?php

require_once '/./list_interfaces.php';

interface IFactoryList {

    public function create_composit($content = null);

    public function create_leaf($content = null);
}

interface ISearch {
    
    public function set_factory_list(IFactoryList $factory);

    public function get_statistics($content);

    public function search(WContent $content);
}

interface IStratSearch {
    
    public function search_content($param);

    public function save_content();
}
