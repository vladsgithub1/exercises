<?php

require_once __DIR__.'/Stack.php';

class  TestingSymmetry
{
    const BRACKETS = ['[' => ']', '<' => '>', '{' => '}' , '(' => ')'];

    private $stack;
    private $string;
    private $key;

    /**
     * TestingSymmetry constructor.
     * @param Stack $stack
     * @param string $string
     */
    public function __construct(Stack $stack, $string = '')
    {
        $this->stack = $stack;
        $this->string = $string;
    }

    /**
     * @return bool
     */
    public function checkBrackets()
    {
        foreach (str_split($this->string) as  $letter) {
            if (key_exists($letter, self::BRACKETS)) {
                $this->stack->in($letter);
                $this->key = $letter;
            } elseif (in_array($letter, self::BRACKETS) && !$this->stack->isEmpty()) {
                $this->key = $this->stack->out();
                if (self::BRACKETS[$this->key] != $letter) {
                    return false;
                }
            } elseif (in_array($letter, self::BRACKETS)) {
                return false;
            }
        }

        return $this->stack->isEmpty();
    }
}

$stack = new Stack();
$string = 'bbb(({[[qqq[]]kkk]fff}yyy))';

$testingSymmetry = new TestingSymmetry($stack, $string);

var_dump($testingSymmetry->checkBrackets());
