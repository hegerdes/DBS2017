<?php

namespace OpiumBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="abstract_user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({User::TYPE_STUDENT = "Student", User::TYPE_EXAMINER = "Examiner", User::TYPE_ADMINISTRATOR = "Administrator"})
 */
abstract class User extends BaseUser
{
    const TYPE_STUDENT = 'student';
    const TYPE_EXAMINER = 'examiner';
    const TYPE_ADMINISTRATOR = 'administrator';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\Length(min="2", max="255")
     *
     * @ORM\Column(name="forename", type="string", length=255, nullable=true)
     */
    private $forename;

    /**
     * @var string
     *
     * @Assert\Length(min="2", max="255")
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    private $surname;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    abstract public function getType();

    /**
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * @param string $forename
     */
    public function setForename($forename)
    {
        $this->forename = $forename;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
}
