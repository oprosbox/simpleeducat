<?php

require_once '/./../interfaces.php';
require_once '/./single_connect.php';

function update_cont_id($result, $item) {
    $title = $item['title'];
    $description = $item['description'];
    $id_content = $item['id_content'];
    $id = $item['id'];
    $result .= " WHEN $id THEN '$title', '$description', $id_content, NOW() \n";
    return $result;
}

function update_list_content($result, $item) {
    $title = $item['title'];
    $description = $item['description'];
    $id_item = $item['id_item'];
    $id = $item['id'];
    $result .= " WHEN $id THEN '$title', '$description', $id_item, NOW() \n";
    return $result;
}

function update_menu($result, $item) {
    $title = $item['title'];
    $description = $item['description'];
    $id_parent = $item['id_parent'];
    $id = $item['id'];
    $result .= " WHEN $id THEN '$title', '$description', $id_parent, NOW() \n";
    return $result;
}

function update_question($result, $item) {
    $title = $item['title'];
    $description = $item['description'];
    $question = $item['question'];
    $id_content = $item['id_content'];
    $id = $item['id_question'];
    $result .= " WHEN $id THEN '$title','$description', '$question',$id_content, NOW() \n";
    return $result;
}

class WTableUpdate extends WSingletonConnect implements ITableUpdate {

    public function data_list_content($page_info) {
        $question = 'UPDATE `content` SET title,description,id_item,time_update = CASE `id_content` \n';
        array_reduce($query, 'update_list_content', $question);
        $question .= ' ELSE title,description,id_item,time_update END;';
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }

    public function menu($themes) {
        $question = 'UPDATE `menu` SET title,description,id_parent,time_update = CASE `id_item` \n';
        array_reduce($query, 'update_menu', $question);
        $question .= 'ELSE title,description,id_parent,time_update END;';
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }

    public function questions($query) {
        $question = 'UPDATE `questions` SET title,description,question,id_content,time_update = CASE `id_question` \n';
        array_reduce($query, 'update_question', $question);
        $question .= 'ELSE title,description,question,id_content,time_update END;';
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }

    public function sources($keys) {
        $question = 'UPDATE `sources` SET title,description,id_content,time_update = CASE `id` \n';
        array_reduce($query, 'update_cont_id', $question);
        $question .= 'ELSE title,description,id_content,time_update END;';
        $result=WLog::mysql_log(self::$link, $question); 
        return $result;
    }
}
