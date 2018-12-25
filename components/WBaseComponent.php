<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./../model/index.php';

class WBaseComponent {

    static public function creator($params) {
       if(empty(self::$strat_data_get)){
           self::$strat_data_get = new WYoutubeDataGetUser;
       }   
    }

    static public function create($params) {
        self::creator($params);
    }
    
    static public $strat_data_get;
    static public $strat_create;
}
