<?php

namespace OpiumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="OpiumBundle\Repository\StudentRepository")
 * @ORM\Table(name="student")
 * @UniqueEntity(fields={"username"}, targetClass="OpiumBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields={"email"}, targetClass="OpiumBundle\Entity\User", message="fos_user.email.already_used")
 */
class Student extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @Assert\Date
     *
     * @ORM\Column(name="date_of_birth", type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var int
     *
     * @Assert\NotNull
     * @Assert\Range(min="100000", max="999999")
     *
     * @ORM\Column(name="matriculation_number", type="integer", unique=true)
     */
    private $matriculationNumber;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OpiumBundle\Entity\ExamParticipation", mappedBy="student")
     */
    private $examParticipations;


    /**
     * Student constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->examParticipations = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return self::TYPE_STUDENT;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return Student
     */
    public function setDateOfBirth(\DateTime $dateOfBirth = null)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * Set matriculationNumber
     *
     * @param integer $matriculationNumber
     *
     * @return Student
     */
    public function setMatriculationNumber($matriculationNumber)
    {
        $this->matriculationNumber = $matriculationNumber;

        return $this;
    }

    /**
     * Get matriculationNumber
     *
     * @return int
     */
    public function getMatriculationNumber()
    {
        return $this->matriculationNumber;
    }

    /**
     * @return ArrayCollection
     */
    public function getExamParticipations(): ArrayCollection
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
}
