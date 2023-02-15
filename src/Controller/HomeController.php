<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(LinkRepository $linkRepository): Response {
        return $this->render('home/index.html.twig', [
            'links' => $linkRepository->findBy([], limit: 20)
        ]);
    }

}