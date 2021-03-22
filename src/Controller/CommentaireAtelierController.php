<?php

namespace App\Controller;

use App\Entity\CommentaireAtelier;
use App\Form\CommentaireAtelierType;
use App\Repository\CommentaireAtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire/atelier")
 */
class CommentaireAtelierController extends AbstractController
{
    /**
     * @Route("/", name="commentaire_atelier_index", methods={"GET"})
     */
    public function index(CommentaireAtelierRepository $commentaireAtelierRepository): Response
    {
        return $this->render('commentaire_atelier/index.html.twig', [
            'commentaire_ateliers' => $commentaireAtelierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commentaire_atelier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentaireAtelier = new CommentaireAtelier();
        $form = $this->createForm(CommentaireAtelierType::class, $commentaireAtelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaireAtelier);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_atelier_index');
        }

        return $this->render('commentaire_atelier/new.html.twig', [
            'commentaire_atelier' => $commentaireAtelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_atelier_show", methods={"GET"})
     */
    public function show(CommentaireAtelier $commentaireAtelier): Response
    {
        return $this->render('commentaire_atelier/show.html.twig', [
            'commentaire_atelier' => $commentaireAtelier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commentaire_atelier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommentaireAtelier $commentaireAtelier): Response
    {
        $form = $this->createForm(CommentaireAtelierType::class, $commentaireAtelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_atelier_index');
        }

        return $this->render('commentaire_atelier/edit.html.twig', [
            'commentaire_atelier' => $commentaireAtelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_atelier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommentaireAtelier $commentaireAtelier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireAtelier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireAtelier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentaire_atelier_index');
    }
}
