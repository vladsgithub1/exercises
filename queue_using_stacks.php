<?php

require_once __DIR__.'/Stack.php';
require_once __DIR__.'/IStructure.php';

class QueueUsingStacks implements IStructure
{
    private $stack1;
    private $stack2;

    /**
     * QueueUsingStacks constructor.
     */
    public function __construct()
    {
        $this->stack1 = new Stack();
        $this->stack2 = new Stack();
    }

    /**
     * @param $value
     */
    public function in($value)
    {
        if ($this->stack1->isEmpty()) {
            $this->stack1->in($value);
        } else {
            while(!$this->stack1->isEmpty()) {
                $this->stack2->in($this->stack1->out());
            }
            $this->stack1->in($value);
            while(!$this->stack2->isEmpty()) {
                $this->stack1->in($this->stack2->out());
            }
        }
    }

    /**
     * @return mixed
     */
    public function out()
    {
        if($this->stack1->isEmpty()) {
            throw new RuntimeException("Queue is empty!");
        }
        return $this->stack1->out();
    }

}

$obj = new QueueUsingStacks();

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
