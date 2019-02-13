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
    protected $status;
    protected $gpa;

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

    /**
     * print information about a Student
     */
    public function showMyself()
    {
        echo "Student: {$this->firstName} {$this->lastName}, {$this->gender}, status: {$this->status}, gpa: {$this->gpa}" . PHP_EOL;
    }

    /**
     * @param $study_time
     * @throws Exception
     */
    public function studyTime($study_time)
    {
        $this->gpa += log($study_time);
        if ($this->gpa > self::MAX_GPA) {
            $this->gpa = self::MAX_GPA;
            throw new Exception( "The gpa of student {$this->firstName} {$this->lastName} is more then " . self::MAX_GPA);
        }
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
    if(method_exists($student, 'studyTime') && !empty($studyTime[$key])) {
        try {
            $student->studyTime($studyTime[$key]);
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
