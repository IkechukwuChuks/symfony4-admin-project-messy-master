<?php

namespace App\Controller\SuperAdmin\User;

use App\Entity\User;
use App\Enum\ResponseCodeEnum;
use App\UseCase\DeleteEntityUseCase;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteUserController
 * @package App\Controller\SuperAdmin\User
 */
class DeleteUserController extends AbstractController
{
    /**
     * @Route("/{user}/delete", name="app_super_admin_delete")
     * @Entity("user", expr="repository.getById(user)")
     *
     * @param User $user
     * @param DeleteEntityUseCase $useCase
     * @return JsonResponse
     */
    public function deleteAction(User $user, DeleteEntityUseCase $useCase): JsonResponse
    {
        $useCase->delete($user);

        return new JsonResponse([], ResponseCodeEnum::RESPONSE_OK);
    }
}
