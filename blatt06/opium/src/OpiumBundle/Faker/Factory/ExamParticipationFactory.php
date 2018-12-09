<?php

namespace OpiumBundle\Faker\Factory;

use OpiumBundle\Entity\Exam;
use OpiumBundle\Entity\ExamParticipation;
use OpiumBundle\Entity\Student;

class ExamParticipationFactory
{
    private $studentInstances;
    private $examInstances;
    private $combinations;


    /**
     * ExamParticipationFactory constructor.
     */
    public function __construct()
    {
        $this->studentInstances = [];
        $this->examInstances = [];
        $this->combinations = [];
    }

    public function create(Student $student, Exam $exam)
    {
        $studentHash = $this->saveStudent($student);
        $examHash = $this->saveExam($exam);

        $combinedHash = $this->generateCombinedHash($studentHash, $examHash);

        for ($i = 0; $i < 150 && in_array($combinedHash, $this->combinations); $i++)
        {
            list($combinedHash, $student, $exam) = $this->getNewCombination();
        }

        if (in_array($combinedHash, $this->combinations)) {
            // search for new combination
            printf("You should never see this. In the unlikely event of fire, please try again! %s\n", $combinedHash);
            die();
        } else {
            $this->combinations[] = $combinedHash;
            $participation = new ExamParticipation();
            $participation->setStudent($student);
            $participation->setExam($exam);
        }

        return $participation;
    }

    private function generateCombinedHash(string $hash1, string $hash2): string
    {
        $hashes = [$hash1, $hash2];
        sort($hashes);
        return sprintf('%s-%s', $hashes[0], $hashes[1]);
    }

    private function getNewCombination(): array
    {
        $student = array_rand($this->studentInstances);
        $exam = array_rand($this->examInstances);
        $combinedHash = $this->generateCombinedHash($student, $exam);
        return [$combinedHash, $this->studentInstances[$student], $this->examInstances[$exam]];
    }

    private function saveStudent(Student $student): string
    {
        $hash = spl_object_hash($student);
        if (!array_key_exists($hash, $this->studentInstances)) {
            $this->studentInstances[$hash] = $student;
        }
        return $hash;
    }

    private function saveExam(Exam $exam): string
    {
        $hash = spl_object_hash($exam);
        if (!array_key_exists($hash, $this->examInstances)) {
            $this->examInstances[$hash] = $exam;
        }
        return $hash;
    }
}
