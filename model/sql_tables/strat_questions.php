<?php

include_once 'interfaces.php';
require_once '/./mysqlbase/single_connect.php';

class WQuestionBD extends WSingletonConnect implements IQuestions{
 
    public function questions() {
        $query = "SELECT * FROM questions";
        $result_query = mysqli_query(self::$link, $query);
        $questions = [];
        while ($row = $result_query->fetch_array()) {
            $questions[$row['id_question']] = array(
                'id_content' => $row['id_content'],
                'title' => $row['title'],
                'description' => $row['description'],
                'question' => $row['question']);
        }
        $result_query->close();
        return $questions;
    }
}

