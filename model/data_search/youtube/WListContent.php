<?php

require_once '/./../search_interfaces.php';

class WLeafContent extends WContent implements ITreeContent {

    static public $save_strat;
    static public $view_strat;

    static public function set_strat_save(IStrategySave $save_strat) {
        self::$save_strat = $save_strat;
    }

    static public function set_strat_view(IStrategyView $view_strat) {
        self::$view_strat = $view_strat;
    }

    public function view(&$body) {
        self::$view_strat->leaf_view($body, $this);
    }

    public function save() {
        self::$save_strat->save($this);
    }

    public function add($param) {
        
    }

    public function get_content($id) {
        if ($this->id === $id)
            return $this;
        else
            return null;
    }

    public function remove($id) {
        if ($this->id === $id)
            return true;
        else
            return false;
    }

}

class WCompositeContent extends WContent implements ITreeContent {

    protected $content = [];
    protected $pos = 0;
    static public $save_strat;
    static public $view_strat;

    static public function set_strat_save(IStrategySave $save_strat) {
        self::$save_strat = $save_strat;
        WLeafContent::$save_strat = $save_strat;
    }

    static public function set_strat_view(IStrategyView $view_strat) {
        self::$view_strat = $view_strat;
        WLeafContent::$view_strat = $view_strat;
    }

    public function save() {
        self::$save_strat->save($this);
        foreach ($this->content as $value) {
            $value->save();
        }
    }

    public function view(&$body) {
        self::$view_strat->composite_view_begin($body, $this);
        foreach ($this->content as $value) {
            $value->view($body);
        }
        self::$view_strat->composite_view_end($body, $this);
    }

    public function to_begin() {
        $this->pos = 0;
    }

    public function get_item() {
        if (!empty($this->content[$this->pos])) {
            $content = $this->content[$this->pos];
            $this->pos += ($this->pos + 1) % count($this->content);
            return $content;
        } else
            return null;
    }

    public function add($composit) {
        $this->content[] = $composit;
    }

    public function get_content($id) {
        if ($this->id === $id)
            return $this;
        foreach ($this->content as $key => $value) {
            $content = $value->get_content($id);
            if ($content !== null)
                return $content;
        }
        return null;
    }

    public function remove($id) {
        foreach ($this->content as $key => $value) {
            if ($value->remove($id) === true) {
                unset($this->content[$key]);
                if (count($this->content) === 0)
                    return true;
            }
        }
        return false;
    }

}
