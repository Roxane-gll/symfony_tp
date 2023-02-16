<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\Type\LinkFormType;
use App\Form\Type\SettingFormType;
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
    public function linkAddForm(Request $request, LinkRepository $linkRepository): Response
    {
        // creates a task object and initializes some data for this example
        $link = new Link();

        $form = $this->createForm(LinkFormType::class, $link);
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

    #[Route('/account/update', name: 'update_setting', methods: ["GET", "POST"])]
    public function accountUpdateForm(Request $request): Response
    {
        // creates a task object and initializes some data for this example

        $form = $this->createForm(SettingFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_home_index');
        }
        return $this->render('account/setting.html.twig', [
            "form" => $form
        ]);
    }
}