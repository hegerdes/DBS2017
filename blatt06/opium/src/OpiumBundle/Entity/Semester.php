<?php

namespace OpiumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Semester
 *
 * @ORM\Table(name="semester")
 * @ORM\Entity(repositoryClass="OpiumBundle\Repository\SemesterRepository")
 */
class Semester
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
     * @ORM\Column(name="identifier", type="string", length=255, unique=true)
     */
    private $identifier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="application_start", type="datetime")
     */
    private $applicationStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="application_end", type="datetime")
     */
    private $applicationEnd;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OpiumBundle\Entity\Exam", mappedBy="semester")
     */
    private $exams;


    /**
     * Semester constructor.
     */
    public function __construct()
    {
        $this->exams = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     *
     * @return Semester
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set applicationStart
     *
     * @param \DateTime $applicationStart
     *
     * @return Semester
     */
    public function setApplicationStart($applicationStart)
    {
        $this->applicationStart = $applicationStart;

        return $this;
    }

    /**
     * Get applicationStart
     *
     * @return \DateTime
     */
    public function getApplicationStart()
    {
        return $this->applicationStart;
    }

    /**
     * Set applicationEnd
     *
     * @param \DateTime $applicationEnd
     *
     * @return Semester
     */
    public function setApplicationEnd($applicationEnd)
    {
        $this->applicationEnd = $applicationEnd;

        return $this;
    }

    /**
     * Get applicationEnd
     *
     * @return \DateTime
     */
    public function getApplicationEnd()
    {
        return $this->applicationEnd;
    }

    /**
     * @return ArrayCollection
     */
    public function getExams(): ArrayCollection
    {
        return $this->exams;
    }

    /**
     * @param Exam $exam
     * @return bool
     */
    public function addExam(Exam $exam): bool
    {
        if (!$this->exams->contains($exam)) {
            $this->exams->add($exam);
            return true;
        }
        return false;
    }

    /**
     * @param Exam $exam
     * @return bool
     */
    public function removeExam(Exam $exam): bool
    {
        if ($this->exams->contains($exam)) {
            $this->exams->removeElement($exam);
            return true;
        }
        return false;
    }
}

