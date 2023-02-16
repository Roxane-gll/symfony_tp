<?php

namespace App\Controller;

use App\Entity\Link;
use App\Entity\Reaction;
use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/link', name:'app_link')]
class LinkController extends AbstractController
{
    #[Route('', name: 'index', methods: ["GET"])]
    public function index(LinkRepository $linkRepository): Response {
        return $this->render('link/index.html.twig', [
            'links' => $linkRepository->findBy([], ['createdAt'=>'DESC'])
        ]);
    }

    #[Route('/{link}', name: 'show', methods: ["GET"])]
    public function show(Link $link): Response
    {
        return  $this->render('link/show.html.twig',
            ['link' => $link]
        );
    }

    #[Route('/delete/{link}', name: 'delete', methods: ["GET"])]
    public function delete(Link $link, LinkRepository $linkRepository): Response{
        $linkRepository->remove($link, true);
        return $this->redirectToRoute('app_linkindex');
    }

    #[Route('/add/reaction/{link}/', name: 'reaction', methods: ["GET"])]
    public function addReaction(Link $link,Request $request, EntityManagerInterface $entityManager) {
        $newReaction = new Reaction();
        $newReaction->setType($request->query->get('type'));
        $newReaction->setCreatedAt(new \DateTimeImmutable());
        $link->addReaction($newReaction);
        $entityManager->persist($newReaction);
        $entityManager->flush();
        return $this->redirectToRoute('app_linkindex');
    }
}