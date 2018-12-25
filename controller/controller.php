<?php

require_once 'controllerClasses.php';
require_once '/./../components/index.php';


class WGetControl {

    public $get_create;
    public $get_update;
    public $page_create;
    public $page_update;
    
    public function __construct() {
        //set funct,id 
        $this->list_set = new WGetList();
        $this->set_content = new WSetContent();
        $list_create = new WFunctList;
        $list_create->add_operation($this->set_content->funct);
        $list_create->add_operation($this->set_content);
        $this->list_set->add_method('id', $this->set_content->id);
        $this->list_set->add_method('funct', $list_create);
        $this->list_set->release_commands('id','funct');
        //update funct,position
        $this->list_update = new WGetList();
        $this->update_content = new WUpdatePage();
        $list_update = new WFunctList;
        $list_update->add_operation($this->update_content->funct);
        $list_update->add_operation($this->update_content);
        $this->list_update->add_method('position', $this->update_content->position);
        $this->list_update->add_method('funct', $list_update);
        $this->list_update->release_commands('position','funct');   
    }
}

session_start();
WControlContent::create_from_session();

$page = new WGetControl();

//if(empty($_GET['funct'])){echo '11111111111';}else{echo '<p>'.$_GET['funct'].'<p>';}
//if(empty($_GET['id'])){echo '2222222222222';}else{echo '<p>'.$_GET['id'].'<p>';}