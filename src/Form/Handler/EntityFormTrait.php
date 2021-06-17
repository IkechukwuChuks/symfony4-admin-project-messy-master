<?php
namespace App\Form\Handler;

use App\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

trait EntityFormTrait
{
    private $encoder;

    /**
     * CreateUserController constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param FormInterface $form
     * @param Request $request
     * @return bool
     */
    public function handleForm(FormInterface $form, Request $request): bool
    {
        $user = new User();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /*
             * Encrypt plainPassword data gotten from form
             */
            $user->setPassword(
                $this->encoder->encodePassword($user, $form->get('plainPassword')->getData())
            );
        }

        return $form->isSubmitted() && $form->isValid();
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function formHasErrors(FormInterface $form): bool
    {
        return $form->isSubmitted() && 0 < count($form->getErrors(true));
    }
}
