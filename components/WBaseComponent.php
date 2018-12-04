<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './../model/index.php';

class WBaseComponent {

    static public function creator() {
       if(empty(self::$strat_data_get)){self::$strat_data_get = new WYoutubeDataGetUser;}   
    }

    static public function create() {
        self::creator();
        return self::$strat_create->create();
    }
    
    static public function component_from_strat() {
        return self::$strat_create->create();
    }
    static public function set_strat_data(IYoutubeDataGetUser $strat_data_get) {
        self::$strat_data_get = $strat_data_get;
    }

    static public function set_strat_view(IStratCompCreate $strat_create) {
        self::$strat_create = $strat_create;
    }

    static public $strat_data_get;
    static public $strat_create;
}
