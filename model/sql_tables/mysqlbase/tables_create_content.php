<?php

require_once '/./single_connect.php';
require_once '/./../interfaces.php';
require_once '/./../../../library/functions.php';

class WTableCreate extends WSingletonConnect implements ITableCreate {

    public function tables() {
        
        $query = file_get_contents(get_home_url() . '/SQLQuestions/create_tables.sql');
        $arr_q= explode(';',$query);
        foreach ($arr_q as $quest)
        $result = mysqli_query(self::$link, $quest);
        return $result;
    }
}
