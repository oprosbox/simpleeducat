<?php

require_once '/./list_interfaces.php';

class WView implements IStrategyView{
    
    public function composite_view(&$body, array $content) {
        
    }

    public function leaf_view(&$body, WContent $content) {
        
    }

}

