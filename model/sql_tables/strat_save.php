<?php

require_once '/./interfaces.php';
require_once '/./mysqlbase/tables_insert_content.php';

class WStratSaveContent extends WTableInsert implements IStrategySave {    
 /**
  * 
  * @param string $content[]
  * 
  */
    public function save($content) {
        if (empty($content[0])) {
            return;
        }
        switch ($content[0]->type) {
            case "youtube#channel":
            case "youtube#playlist":
            case "youtube#video": {
                    $this->sources($content);
                }
        }
    }
}

