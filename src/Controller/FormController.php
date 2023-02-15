<?php

namespace App\Controller;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('link/add', name: 'add_link', methods: ["GET", "POST"])]
    public function new(Request $request, LinkRepository $linkRepository): Response
    {
        // creates a task object and initializes some data for this example
        $link = new Link();

        $form = $this->createFormBuilder($link)
            ->add('title', TextType::class)
            ->add('url', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Link'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $link->setCreatedAt(new \DateTimeImmutable());
            $linkRepository->save($link, true);
            return $this->redirectToRoute('app_linkindex');
        }
        return $this->render('link/add.html.twig', [
            "form" => $form
        ]);
    }
}