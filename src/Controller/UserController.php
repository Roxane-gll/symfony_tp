<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('user', name: 'app_user')]
class UserController extends AbstractController
{
    #[Route('/{userId}', name:'show.html.twig')]
    public function show(?int $userId): Response {
        if (!$userId) {
            $this->render('user/index.html.twig');
        }
        return $this->render('user/index.html.twig', ['user' => $userId]);
    }
}