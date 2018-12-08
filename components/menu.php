<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WBaseComponent.php';
require_once '/./WStratMenu.php';

class CMenu extends WBaseComponent{

    static public function creator($params) {
        WBaseComponent::creator($params);
        WBaseComponent::$strat_create = new WMenuCreate;
    }
    
     static public function create($params) {
        self::creator($params);
        return WBaseComponent::$strat_create->create();
    }
}
