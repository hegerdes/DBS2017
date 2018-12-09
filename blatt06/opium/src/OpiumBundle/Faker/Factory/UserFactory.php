<?php

namespace OpiumBundle\Faker\Factory;

use OpiumBundle\Entity\Student;
use OpiumBundle\Entity\User;
use PUGX\MultiUserBundle\Doctrine\UserManager;
use PUGX\MultiUserBundle\Model\UserDiscriminator;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class UserFactory
{
    /**
     * @var UserDiscriminator
     */
    private $discriminator;
    /**
     * @var UserManager
     */
    private $manager;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * UserProvider constructor.
     * @param UserDiscriminator $discriminator
     * @param UserManager $manager
     * @param ContainerInterface $container
     */
    public function __construct(
        UserDiscriminator $discriminator,
        UserManager $manager,
        ContainerInterface $container
    ) {
        $this->discriminator = $discriminator;
        $this->manager = $manager;
        $this->container = $container;
    }

    public function administrator(
        string $username,
        string $mail,
        string $password,
        string $forename = null,
        string $surname = null
    ) {
        $this->discriminator->setClass('OpiumBundle\Entity\Administrator');

        /** @var User $user */
        $user = $this->manager->createUser();
        $user->setUsername($username);
        $user->setEmail($mail);
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $user->setForename($forename);
        $user->setSurname($surname);
        $user->addRole('ROLE_SUPER_ADMIN');

        $this->manager->updateUser($user);
        return $user;
    }

    public function examiner(
        string $username,
        string $mail,
        string $password,
        string $forename = null,
        string $surname = null
    ) {
        $this->discriminator->setClass('OpiumBundle\Entity\Examiner');

        /** @var User $user */
        $user = $this->manager->createUser();
        $user->setUsername($username);
        $user->setEmail($mail);
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $user->setForename($forename);
        $user->setSurname($surname);
        $user->addRole('ROLE_ADMIN');

        $this->manager->updateUser($user);
        return $user;
    }

    public function student(
        string $username,
        string $mail,
        string $password,
        string $forename = null,
        string $surname = null,
        \DateTime $dateOfBirth,
        int $matrNr = null
    ) {
        $this->discriminator->setClass('OpiumBundle\Entity\Student');

        /** @var User $user */
        $user = $this->manager->createUser();
        $user->setUsername($username);
        $user->setEmail($username.$mail);
        $user->setPlainPassword($username);
        $user->setEnabled(true);
        $user->setForename($forename);
        $user->setSurname($surname);
        $user->addRole('ROLE_USER');

        if ($user instanceof Student) {
            $user->setDateOfBirth($dateOfBirth);
            $user->setMatriculationNumber($matrNr);
        }

        $this->manager->updateCanonicalFields($user);
        $this->manager->updatePassword($user);

        return $user;
    }
}
