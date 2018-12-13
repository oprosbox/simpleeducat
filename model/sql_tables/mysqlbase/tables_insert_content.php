<?php

require_once '/./single_connect.php';
require_once '/./../interfaces.php';


function data_to_string($result, $item) {
    $res = '(\'' . $item->id . '\',';
    if ($item->id_parent != '') {
        $res .= '\'' . $item->id_parent . '\',';
    } else {
        $res .= 'NULL,';
    }
    $res .= ' $$ ,';
    $res .= '\'' . WSingletonConnect::$link->escape_string($item->type) . '\',';
    if ($item->title != null) {
        $res .= '\'' . WSingletonConnect::$link->escape_string(htmlspecialchars_decode($item->title)) . '\',';
    } else {
        $res .= 'NULL,';
    }
    if ($item->description != null) {
        $res .= '\'' . WSingletonConnect::$link->escape_string(htmlspecialchars_decode($item->description)) . '\',';
    } else {
        $res .= 'NULL,';
    }
    if ($item->statistics != null) {
        $res .= '\'' . WSingletonConnect::$link->escape_string(json_encode($item->statistics)) . '\',';
    } else {
        $res .= 'NULL,';
    }
    $res .= 'NOW()),';
    $result .= $res;
    return $result;
}

function question_to_string($result, $item) {
    $result .= '(\'' . WSingletonConnect::$link->escape_string($item['title']) . '\',';
    $result .= '\'' . WSingletonConnect::$link->escape_string($item['question']) . '\',';
    $result .= $item['id_content'] . '),';
    return $result;
}

function menu_to_string($result, $item) {
    $result .= '(\'' . WSingletonConnect::$link->escape_string($item['title']) . '\',';
    $result .= $item['id_parent'] . '),';
    return $result;
}

function content_to_string($result, $item) {
    $result .= '(\'' . WSingletonConnect::$link->escape_string($item['title']) . '\',';
    $result .= '\'' . WSingletonConnect::$link->escape_string($item['description']) . '\',';
    $result .= $item['id_item'] . '),';
    return $result;
}

class WTableInsert extends WSingletonConnect implements ITableInsert {

    public function get_id_content() {
        return $this->id_content;
    }

    public function set_id_content($id_content) {
        $this->id_content = $id_content;
        return $this;
    }

       static private $id_content;
       
    public function data_list_content($page_info) {
        $question = "INSERT INTO `content`(title,description,id_item) VALUES ";
        array_reduce($page_info, 'content_to_string', $question);
        $question = rtrim($question, ',');
        $result=WLog::mysql_log(self::$link, $question);
        return $result;
    }

    public function menu($themes) {
        $question = "INSERT INTO `menu` (title,id_parent) VALUES ";
        array_reduce($themes, 'menu_to_string', $question);
        $question = rtrim($question, ',');
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }

    public function questions($query) {
        $question = "INSERT INTO `questions`(title,question,id_content) VALUES ";
        array_reduce($query, 'question_to_string', $question);
        $question = rtrim($question, ',');
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }

    public function sources($sources) {
        $question = "INSERT INTO `sources` (id,id_parent,id_content,type_source,title,description,statistics,time_update) VALUES ";
        $question = array_reduce($sources, 'data_to_string', $question);
        $question = str_replace('$$', $this->id_content, $question);
        $question = rtrim($question, ',');
        $question .= ' ON DUPLICATE KEY UPDATE id_parent=VALUES(id_parent),'
                . 'id_content = VALUES(id_content),'
                . 'type_source = VALUES(type_source),'
                . 'title= VALUES(title),'
                . 'description=VALUES(description), '
                . 'statistics=VALUES(statistics), '
                . 'time_update=NOW();';
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }

}
