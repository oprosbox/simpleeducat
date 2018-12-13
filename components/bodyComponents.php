<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '/./WBaseComponent.php';
require_once '/./WBodyList.php';
require_once '/./WNavContent.php';
require_once '/./WStratMenu.php';
/**
 * CComponent Сlasses
 */
class CComponent extends WBaseComponent {

    /**
     * 
     * @param type $params 
     * принимает значения:
     * WBodyVideo, 
     * WBodyPlaylist, 
     * WBodyListChannel, 
     * WBodyChannel, 
     * WNav, 
     * WMenu 
     * 
     * @return string
     */
    static public function create($params) {
        WBaseComponent::creator($params);
        WBaseComponent::$strat_create = new $params;
        return WBaseComponent::$strat_create->create();
    }

}
