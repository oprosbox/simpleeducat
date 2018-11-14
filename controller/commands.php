<?php


interface WFunct {//базовый интерфейс для описания функции комманды

    public function operation($value);
}

class WFunct_list implements WFunct {//формирования списка функций для одной комманды

    protected $array_funct = array();

    public function add_operation(WFunct $funct) {
        array_push($this->array_funct, $funct);
        return $this;
    }

    public function operation($value) {
        foreach ($this->array_funct as $funct) {
            $funct->operation($value);
        }
    }

}

abstract class WCommand_list {//формирование списка комманд,идентификация по параметру name

    protected $array_comm = array();

    public function add_method($name, WFunct $funct_list) {
        $this->array_comm[$name] = $funct_list;
        return $this;
    }

    public function get_obj($name) {
        if (isset($this->array_comm[$name])) {
            return $this->array_comm[$name];
        } else
            return false;
    }

    public function delete_method($name) {
        unset($this->array_comm[$name]);
        return $this;
    }

    public function start($name, $value) {
        $this->array_comm[$name]->operation($value);
        return $this;
    }

    abstract protected function release_commands($name);
}

abstract class WCommand_Message extends WCommand_list {//список имен сообщений,идентификация по пришедшему

    protected $array_mess = array();

    public function add_name_mess($name) {
        array_push($this->array_mess, $name);
        return $this;
    }

    public function delete_name_mess($name) {
        $key=array_keys($this->array_mess,$name);
        unset($key);
        $this->array_mess = array_values($this->array_mess);
        return $this;
    }

}
