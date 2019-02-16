<?php

require_once __DIR__.'/Queue.php';
require_once __DIR__.'/IStructure.php';

class StackUsingQueues implements IStructure
{
    private $queue1;
    private $queue2;

    /**
     * StackUsingQueues constructor.
     */
    public function __construct()
    {
        $this->queue1 = new Queue();
        $this->queue2 = new Queue();
    }

    /**
     * @param $value
     */
    public function in($value)
    {
        if ($this->queue1->isEmpty()) {
            $this->queue1->in($value);
        } else {
            while(!$this->queue1->isEmpty()) {
                $this->queue2->in($this->queue1->out());
            }
            $this->queue1->in($value);
            while(!$this->queue2->isEmpty()) {
                $this->queue1->in($this->queue2->out());
            }
        }
    }

    /**
     * @return mixed
     */
    public function out()
    {
        if($this->queue1->isEmpty()) {
            throw new RuntimeException("Stack is empty!");
        }
        return $this->queue1->out();
    }

}

$obj = new StackUsingQueues();

for($i = 0; $i < 10; $i++) {
    $obj->in($i.'abc');
}

try {
    for($i = 0; $i < 15; $i++) {
        var_dump($obj->out());
    }
} catch (Exception $e) {
    print_r($e->getMessage() . PHP_EOL);
}
