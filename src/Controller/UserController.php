<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route( "/user" , name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="_all" , methods={"GET"})
     */
    public function userAll(): Response
    {
        return $this->render('user/user.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @param ValidatorInterface $validator
     * @return Response
     * @Route("/user", name="craete_user")
     */
    public function create(ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('');
        $user->setEmail('jone@doe.com');
        $user->setPassword('password');
        $user->setUserRole('admin');

        $errors = $validator->validate($user);

        if (count($errors) > 0){
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $entityManager->persist($user);

        $entityManager->flush();

        return new Response('Saved new user with id '. $user->getId());
    }
}
