<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WSingletonConnect {

    static public $link;

    static public function create() {
        if (empty(self::$link)) {
            self::$link = mysqli_connect(HOST_MYSQL, LOGIN_MYSQL, PASSWORD_MYSQL, DB_MYSQL);
        }
        return self::$link;
    }

    static public function destroy() {
        if (!empty(self::$link))
            mysqli_close(self::$link);
    }

}
