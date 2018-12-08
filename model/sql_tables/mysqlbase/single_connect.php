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
            /* Устанавливаем кодировку для корректного вывода в браузере */
            $query = "SET NAMES 'utf8'";
            mysqli_query(self::$link, $query);

            /* Устанавливаем кодировку для корректного collation */
            $query2 = "SET SESSION collation_connection = 'utf8_general_ci';";
            mysqli_query(self::$link, $query2);
        }
        return self::$link;
    }

    static public function destroy() {
        if (!empty(self::$link))
            mysqli_close(self::$link);
    }

}
