<?php

require_once '/./single_connect.php';
require_once '/./../interfaces.php';

function data_to_string($result, $item) {
    $res = '(\''. $item->id. '\',';
    if($item->id_parent!=''){$res .= '\''.$item->id_parent. '\',';}else{$res .= 'NULL,';}
    $res .= 'NULL,';
    $res .= '\''.WSingletonConnect::$link->escape_string($item->type) . '\',';
    $res .= '\''.WSingletonConnect::$link->escape_string(htmlspecialchars_decode($item->title)) . '\',';
    //$res .= 'NULL,';
    $res .= '\''.WSingletonConnect::$link->escape_string(htmlspecialchars_decode($item->description)) . '\',';
    $res .='\''.WSingletonConnect::$link->escape_string(json_encode($item->statistics)) . '\',';
    $res .= 'NOW()),';
    var_dump($res);
    $result.=$res;
    return $result;
}

function question_to_string($result, $item) {
    $result .= '(' . $item['id'] . ',';
    $result .= $item['title'] . ',';
    $result .= $item['id_content'] . '),';
    return $result;
}

function menu_to_string($result, $item) {
    $result .= '(' . $item['title'] . ',';
    $result .= $item['id_parent'] . '),';
    return $result;
}

function content_to_string($result, $item) {
    $result .= '(' . $item['title'] . ',';
    $result .= $item['description'] . ',';
    $result .= $item['id_item'] . '),';
    return $result;
}

class WTableInsert extends WSingletonConnect implements ITableInsert {

    public function data_list_content($page_info) {
        $question = "INSERT INTO `simpleedu`.`content`(title,description,id_item) VALUES ";
        array_reduce($page_info, 'content_to_string', $question);
        $question = rtrim($question, ',');
        $result = mysqli_query(self::$link, $question);
        return $result;
    }

    public function menu($themes) {
        $question = "INSERT INTO `simpleedu`.`menu` (title,id_parent) VALUES ";
        array_reduce($themes, 'menu_to_string', $question);
        $question = rtrim($question, ',');
        $result = mysqli_query(self::$link, $question);
        return $result;
    }

    public function questions($query) {
        $question = "INSERT INTO `simpleedu`.`questions`(title,question,id_content) VALUES ";
        array_reduce($query, 'question_to_string', $question);
        $question = rtrim($question, ',');
        $result = mysqli_query(self::$link, $question);
        return $result;
    }

    public function sources($sources) {
        $question = "INSERT INTO `sources` (id,id_parent,id_content,type_source,title,description,statistics,time_update) VALUES ";
        // var_dump($sources);
        $question=array_reduce($sources, 'data_to_string', $question);
        $question = rtrim($question, ',');
        $question .= ' ON DUPLICATE KEY UPDATE id_parent=VALUES(id_parent),'
                . 'type_source = VALUES(type_source),'
                . 'title= VALUES(title),'
                . 'description=VALUES(description), '
                . 'statistics=VALUES(statistics), '
                . 'time_update=NOW();';
        var_dump($question);
        $result = mysqli_query(self::$link, $question);
        var_dump($result);
        return $result;
    }

}
