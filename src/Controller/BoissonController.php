<?php

namespace App\Controller;

use App\Entity\Boisson;
use App\Form\BoissonType;
use App\Repository\BoissonRepository;
use App\Service\ContainerParametersHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/boisson")
 */
class BoissonController extends AbstractController
{
    /**
     * @Route("/", name="boisson_index", methods={"GET"})
     */
    public function index(BoissonRepository $boissonRepository): Response
    {
        return $this->render('boisson/index.html.twig', [
            'boissons' => $boissonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="boisson_new", methods={"GET","POST"})
     * @param Request $request
     * @param SluggerInterface $slugger
     * @param ContainerParametersHelper $pathHelpers
     * @return Response
     */
    public function new(Request $request, SluggerInterface $slugger, ContainerParametersHelper $pathHelpers): Response
    {
        $boisson = new Boisson();
        $form = $this->createForm(BoissonType::class, $boisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            $dir = $pathHelpers->getApplicationRootDir()."/public/image/";
            $file->move($dir, $newFilename);

            $boisson->setImage($newFilename);





            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($boisson);
            $entityManager->flush();

            return $this->redirectToRoute('boisson_index');
        }

        return $this->render('boisson/new.html.twig', [
            'boisson' => $boisson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="boisson_show", methods={"GET"})
     */
    public function show(Boisson $boisson): Response
    {
        return $this->render('boisson/show.html.twig', [
            'boisson' => $boisson,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="boisson_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Boisson $boisson): Response
    {
        $form = $this->createForm(BoissonType::class, $boisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('boisson_index');
        }

        return $this->render('boisson/edit.html.twig', [
            'boisson' => $boisson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="boisson_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Boisson $boisson): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boisson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($boisson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('boisson_index');
    }
}
