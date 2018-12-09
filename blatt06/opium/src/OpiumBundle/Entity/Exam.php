<?php

namespace OpiumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exam
 *
 * @ORM\Table(name="exam")
 * @ORM\Entity(repositoryClass="OpiumBundle\Repository\ExamRepository")
 */
class Exam
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
     * @var int
     *
     * @ORM\Column(name="appointment", type="smallint")
     */
    private $appointment;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="smallint", nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="smallint")
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var Semester
     *
     * @ORM\ManyToOne(targetEntity="OpiumBundle\Entity\Semester", inversedBy="exams")
     * @ORM\JoinColumn(name="semester_id", referencedColumnName="id")
     */
    private $semester;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="OpiumBundle\Entity\Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $room;

    /**
     * @var Examiner
     *
     * @ORM\ManyToOne(targetEntity="OpiumBundle\Entity\Examiner")
     * @ORM\JoinColumn(name="examiner_id", referencedColumnName="id")
     */
    private $examiner;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OpiumBundle\Entity\ExamParticipation", mappedBy="exam")
     */
    private $examParticipations;


    /**
     * Exam constructor.
     */
    public function __construct()
    {
        $this->examParticipations = new ArrayCollection();
    }

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
     * Set appointment
     *
     * @param integer $appointment
     *
     * @return Exam
     */
    public function setAppointment($appointment)
    {
        $this->appointment = $appointment;

        return $this;
    }

    /**
     * Get appointment
     *
     * @return int
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Exam
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Exam
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Exam
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Exam
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return Semester
     */
    public function getSemester(): Semester
    {
        return $this->semester;
    }

    /**
     * @param Semester $semester
     */
    public function setSemester(Semester $semester)
    {
        $this->semester = $semester;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
    }

    /**
     * @return Examiner
     */
    public function getExaminer(): Examiner
    {
        return $this->examiner;
    }

    /**
     * @param Examiner $examiner
     */
    public function setExaminer(Examiner $examiner)
    {
        $this->examiner = $examiner;
    }

    /**
     * @return ArrayCollection
     */
    public function getExamParticipations()
    {
        return $this->examParticipations;
    }

    /**
     * @param ExamParticipation $examParticipation
     * @return bool
     */
    public function addExamParticipation(ExamParticipation $examParticipation): bool
    {
        if (!$this->examParticipations->contains($examParticipation)) {
            $this->examParticipations->add($examParticipation);
            return true;
        }
        return false;
    }

    /**
     * @param ExamParticipation $examParticipation
     * @return bool
     */
    public function removeExamParticipation(ExamParticipation $examParticipation): bool
    {
        if ($this->examParticipations->contains($examParticipation)) {
            $this->examParticipations->removeElement($examParticipation);
            return true;
        }
        return false;
    }

    public function getExamParticipationForExam(Exam $exam)
    {
        return $this->examParticipations->filter(function (ExamParticipation $participation) use ($exam) {
            return $participation->getExam()->getId() == $exam->getId();
        })->first();
    }
}

