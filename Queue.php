<?php

require_once __DIR__.'/Structure.php';

class Queue extends Structure
{
    private $head = 0;
    private $tail = 0;

    public function in($value)
    {
        $this->hranilishche[$this->tail++] = $value;
    }

    public function isEmpty() {
        return $this->head === $this->tail;
    }

    public function out()
    {
        if($this->isEmpty()) {
            throw new RuntimeException("Queue is empty");
        }

        $res = $this->hranilishche[$this->head++];
        if($this->head > $this->tail) {
            $this->head = $this->tail = 0;
        }
        return $res;
    }
}

$obj = new Queue();
// /// //
$obj->in(5);
$obj->in(5);
$obj->in(5);
$obj->in(5);
$text = serialize($obj);
file_put_contents('test.txt', $text);