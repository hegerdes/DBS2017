<?php

namespace OpiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="administrator")
 * @UniqueEntity(fields={"username"}, targetClass="OpiumBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields={"email"}, targetClass="OpiumBundle\Entity\User", message="fos_user.email.already_used")
 */
class Administrator extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return string
     */
    public function getType()
    {
        return self::TYPE_ADMINISTRATOR;
    }
}
