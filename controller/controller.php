<?php

require_once 'controllerClasses.php';
require_once '/./../components/index.php';


class WGetControl {

    public $get;
    public $page;
    
/**
 * 
 */
    public function __construct() {
        $this->get = new WGetList();
        $this->page = new WCreatePage();
        
        $list = new WFunctList;
        $list->add_operation($this->page->type);
        $list->add_operation($this->page);
        
        $this->get->add_method('id', $this->page->id);
        $this->get->add_method('type', $list);
    }

}

$page = new WGetControl();
