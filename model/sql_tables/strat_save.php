<?php

require_once '/./interfaces.php';
require_once 'tables_insert_content.php';
require_once 'tables_update_content.php';

class WStratSaveContent extends WTableInsert implements IStrategySave{
    
    public function save(WContent $content) {
        
    }

}

