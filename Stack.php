<?php

//require_once __DIR__.'/IStack.php';
require_once __DIR__.'/Structure.php';

class Stack extends Structure
{
    private $top = 0;

    public function in($value)
    {
        $this->hranilishche[$this->top++] = $value;

    }

    public function isEmpty() {
//        return empty($this->top);
        return $this->top === 0;
    }

    public function last() {
        if($this->isEmpty()) {
            throw new RuntimeException("Stack is empty!");
        }
        return $this->hranilishche[$this->top-1];
    }

    public function out()
    {
        if($this->isEmpty()) {
            throw new RuntimeException("Stack is empty!");
        }
        return $this->hranilishche[--$this->top];
    }
}

$obj = new Stack();
//var_dump($obj->isEmpty());
for($i = 0; $i< 10; $i++) {
    $obj->in($i.'abc');
}
//var_dump($obj->isEmpty());
//var_dump($obj->last());
for($i = 0; $i< 15; $i++) {
    var_dump($obj->out());
}
//var_dump($obj->out());
//var_dump($obj->out());
//var_dump($obj->out());
//var_dump($obj->out());