<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./interfaces.php';
require_once '/./../model/index.php';

class WMenu implements IStratCompCreate {
    
    public function update($param=null) {$this->create();}

 /**
 *
 * @var array 
 */
    private $menu_items;
    /**
     *
     * @var array содержит классы вложенных кнопок 
     */
    private $button_classes=array('btn list-group-item list-group-item-action list-group-item-primary collapsed ',
                                  'btn list-group-item list-group-item-action list-group-item-info collapsed',
                                  'btn list-group-item list-group-item-action list-group-item-success collapsed',
                                  'btn list-group-item list-group-item-action list-group-item-dark collapsed',
                                  'btn list-group-item list-group-item-action list-group-item-secondary collapsed');

    private function new_li($child, $key,&$ind) {
        $title = $child['title'];
        $ul = $this->create_list($key,$ind);
        if (!is_null($ul)) {
          $btn_class=$this->button_classes[$ind];
          $out='<div class="accordion list-group" id="accordionExample_'.$key.'">'
          .'<button class="'.$btn_class.' dropdown-toggle" type="button" data-toggle="collapse" data-target="#id_'.$key.'" aria-expanded="false">'
          .$title.'</button>
          <div id="id_'.$key.'" class="collapse"  data-parent="#accordionExample_'.$key.'">'
          .$ul.
          '</div></div>';
          return $out;
        } else {$btn_class=$this->button_classes[$ind];
                return '<button id="item_'.$key.'" class="menu_item '.$btn_class.'" type="button">'.$title.'</button>';}
    }

    private function create_list($id,$ind) {
        $child_ul = null;
        $ind++;
        foreach ($this->menu_items as $key => $item) {
            if ($id == $item['id_parent']) {
                $child = $item;
                unset($this->menu_items[$key]);
                $low=$ind;
                $child_ul .= $this->new_li($child, $key,$low);
            }
        }
        if (!is_null($child_ul)) {
            return  $child_ul ;
        } else
            return null;
    }
/**
 * публикует меню
 */
    public function create() {
        $this->menu_items = WBaseComponent::$strat_data_get->menu();
        ?>
        <div class="row">
	   <div class="col-lg-12">
            <?php $ind=-1;
            $ul = $this->create_list(null,$ind);
            echo $ul;
                    ?>  
        </div>
            </div>
        <?php
    }

}
