<?php

require_once 'controllerClasses.php';
require_once '/./../components/index.php';


class WGetControl {

    public $get_create;
    public $get_update;
    public $page_create;
    public $page_update;
    
    public function __construct() {
        $this->get_create = new WGetList();
        $this->get_update = new WGetList();
        $this->page_create = new WCreatePage();
        $this->page_update = new WUpdatePage();
        //create 
        $list_create = new WFunctList;
        $list_create->add_operation($this->page_create->type);
        $list_create->add_operation($this->page_create);
        $this->get_create->add_method('id', $this->page_create->id);
        $this->get_create->add_method('type', $list_create);
        $this->get_create->release_commands('id','type');
        //update
        $list_update = new WFunctList;
        $list_update->add_operation($this->page_update->count);
        $list_update->add_operation($this->page_update);
        $this->get_update->add_method('type', $this->page_update->type);
        $this->get_update->add_method('position', $list_update);
        $this->get_update->release_commands('type','position');   
    }
}

$page = new WGetControl();
