<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WLog {
   static public $name='/logfile/messages.log'; 
   
   static public function add_to_log($message){
       $message.=PHP_EOL;
       error_log($message,3,self::$name);  
   }
   
   static public function mysql_log($link,$query){
       $result=mysqli_query($link, $query);
     if (!$result) {
            $err_log = mysqli_error($link);
            $message = $query . ' ; ' . $err_log;
            WLog::add_to_log($message);
   }
   return $result;
     }
}