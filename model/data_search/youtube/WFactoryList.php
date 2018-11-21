<?php

require_once 'WRequest.php';

class WFactoryList implements IFactoryList{
    public function create_composit($content = null) {
        $composit;
        if($content!==null){$composit=clone $content;}
        else{$composit=new WCompositeRequest();}
        return $composit; 
    }

    public function create_leaf($content = null) {
        return new WLeafRequest($content);   
    }
}

