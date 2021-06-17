<?php

namespace App\UseCase;

use App\Entity\Interfaces\SoftDeletableInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DeleteEntityUseCase
 * @package App\UseCase
 */
class DeleteEntityUseCase
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param SoftDeletableInterface $entity
     */
    public function delete(SoftDeletableInterface $entity)
    {
        if (!$entity->isDeleted()) {
            $entity->setDeleted(true);

            $this->em->persist($entity);
            $this->em->flush();
        }
    }
}
