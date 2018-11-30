<?php

require_once '/./../list_interfaces.php';

class WStratView implements IStrategyView{
    
    public function composite_view_begin(&$body, $content) {
    var_dump($content);  
    }

    public function composite_view_end(&$body, $content) {
        
    }

    public function leaf_view(&$body, WContent $content) {   
    }

}

