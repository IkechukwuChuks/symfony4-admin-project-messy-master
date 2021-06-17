<?php

namespace App\UseCase\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class DeleteUserUseCase
 * @package App\UseCase
 */
class DeleteUserUseCase
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Security
     */
    private $security;

    /**
     * DeleteUserUseCase constructor.
     *
     * @param EntityManagerInterface $em
     * @param Security $security
     */
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @param User $entity
     */
    public function delete(User $entity)
    {
        $loggedInUser = $this->security->getUser();

        /*
         * Checking if authenticated user is the same as user about to be deleted
         */
        if($entity !== $loggedInUser) {
            if (!$entity->isDeleted()) {
                $entity->setDeleted(true);

                $this->em->persist($entity);
                $this->em->flush();
            }
        }
    }
}
