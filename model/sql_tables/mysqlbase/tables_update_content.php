<?php

require_once '/./../interfaces.php';
require_once '/./tables_insert_content.php';

class WTableUpdate extends WTableInsert implements ITableUpdate {

    public function data_list_content($page_info) {
        $title = $page_info['title'];
        $description = $page_info['description'];
        $id_item = $page_info['id_item'];
        $id = $page_info['id'];
        $question = "UPDATE 'content' SET (title,description,id_item)="
                . "($title,$description,$id_item) WHERE 'content'.'id_content'=$id ";
        $result = mysqli_query(self::$link, $question);
        return $result;
    }

    public function menu($themes) {
        $title = $themes['title'];
        $id_parent = $themes['id_parent'];
        $description = $themes['description'];
        $id = $themes['id'];
        $question = "UPDATE 'menu' SET (title,description,id_parent)="
                . "($title,$description,$id_parent) WHERE 'menu'.'id_item'=$id ";
        $result = mysqli_query(self::$link, $question);
        return $result;
    }

    public function questions($query) {
        $title = $query['title'];
        $id_content = $query['id_content'];
        $question = $query['question'];
        $id = $query['id_question'];
        $question_sql = "UPDATE 'menu' SET (title,question,id_content)="
                . "($title,$question,$id_content) WHERE 'questions'.'id_question'=$id ";
        $result = mysqli_query(self::$link, $question_sql);
        return $result;
    }

}
