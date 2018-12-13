<?php

include_once 'interfaces.php';
require_once '/./mysqlbase/single_connect.php';

class WQuestionBD extends WSingletonConnect implements IQuestions{
 /**
  * 
  * @return string[]
  */
    public function questions() {
        $query = "SELECT * FROM questions";
        $result_query = mysqli_query(self::$link, $query);
        $questions = [];
        while ($row = $result_query->fetch_array()) {
            $questions[$row['id_question']] = array(
                'type_quest' => $row['type_quest'],
                'id_content' => $row['id_content'],
                'title' => $row['title'],
                'description' => $row['description'],
                'question' => $row['question']);
        }
        $result_query->close();
        return $questions;
    }
}

