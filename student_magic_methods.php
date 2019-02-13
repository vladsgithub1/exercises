<?php

class Student
{
    const GENDER_TYPES = [
        'male',
        'female',
    ];
    const STATUS_TYPES = [
        'freshman',
        'sophomore',
        'junior',
        'senior',
    ];
    const MAX_GPA = 4;

    protected $firstName;
    protected $lastName;
    protected $gender;
    protected $gpa;
    protected $values = [];

    /**
     * Student constructor.
     * @param $firstName
     * @param $lastName
     * @param $gender
     * @param $status
     * @param int $gpa
     * @throws Exception
     */
    public function __construct($firstName, $lastName, $gender, $status, $gpa = 0)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        if (!in_array($gender, self::GENDER_TYPES)) {
            throw new Exception('Wrong param gender! The param ' . $gender . ' should be from list: ' . implode(', ', self::GENDER_TYPES));
        } elseif (!in_array($status, self::STATUS_TYPES)) {
            throw new Exception('Wrong param status! The param ' . $status . ' should be from list: ' . implode(', ', self::STATUS_TYPES));
        }
        $this->gender = $gender;
        $this->status = $status;
        $this->gpa = $gpa;
    }

    public function __destruct()
    {
        echo "Instance of Student: {$this->firstName} {$this->lastName} was destruct" . PHP_EOL;
    }

    /**
     * @param $name
     * @param $arguments
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if ($name == 'studyTime' && !empty($arguments[0])) {
            $this->gpa += log($arguments[0]);
            if ($this->gpa > self::MAX_GPA) {
                $this->gpa = self::MAX_GPA;
                throw new Exception( "The gpa of student {$this->firstName} {$this->lastName} is more then " . self::MAX_GPA);
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name == 'status') {
            return $this->values[$name];
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * @param $studyTime
     * @throws Exception
     */
    public function __invoke($studyTime)
    {
        $this->studyTime($studyTime);
    }

    /**
     * print information about a Student
     */
    public function showMyself()
    {
        echo "Student: {$this->firstName} {$this->lastName}, {$this->gender}, status: {$this->status}, gpa: {$this->gpa}" . PHP_EOL;
    }

}

$studentsList = [
    ['Mike', 'Barnes', 'male', 'freshman'],
    ['Jim', 'Nickerson', 'male', 'sophomore'],
    ['Jack', 'Indabox', 'male', 'junior'],
    ['Jane', 'Miller', 'female', 'senior'],
    ['Mary', 'Scott', 'female', 'senior'],
];

$students = [];

foreach ($studentsList as $key => $student) {
    try {
        $students[] = new Student(...$student);
    } catch (Exception $e) {
        print_r($e->getMessage() . PHP_EOL);
    }
}

$studyTime = [60, 100, 40, 300, 1000];

foreach ($students as $key => $student) {
    if(!empty($studyTime[$key])) {
        try {
            $student($studyTime[$key]);
        } catch (Exception $e) {
            print_r($e->getMessage() . PHP_EOL);
        }
    }
}

foreach ($students as $student) {
    if(method_exists($student, 'showMyself')) {
        $student->showMyself();
    }
}
