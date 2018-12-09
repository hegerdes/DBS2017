<?php

namespace OpiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamParticipation
 *
 * @ORM\Table(name="exam_participation", uniqueConstraints={@ORM\UniqueConstraint(name="student_exam", columns={"student_id", "exam_id"})})
 * @ORM\Entity(repositoryClass="OpiumBundle\Repository\ExamParticipationRepository")
 */
class ExamParticipation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="grade", type="decimal", precision=2, scale=1, nullable=true)
     */
    private $grade;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="OpiumBundle\Entity\Student", inversedBy="examParticipations")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;

    /**
     * @var Exam
     *
     * @ORM\ManyToOne(targetEntity="OpiumBundle\Entity\Exam", inversedBy="examParticipations")
     * @ORM\JoinColumn(name="exam_id", referencedColumnName="id")
     */
    private $exam;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return ExamParticipation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set grade
     *
     * @param string $grade
     *
     * @return ExamParticipation
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

    /**
     * @return Exam
     */
    public function getExam(): Exam
    {
        return $this->exam;
    }

    /**
     * @param Exam $exam
     */
    public function setExam(Exam $exam)
    {
        $this->exam = $exam;
    }
}

