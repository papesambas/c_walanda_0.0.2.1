<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Form\ElevesType;
use App\Repository\ElevesRepository;
use App\Repository\ParentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/eleves')]
final class ElevesController extends AbstractController
{
    #[Route(name: 'app_eleves_index', methods: ['GET'])]
    public function index(ElevesRepository $elevesRepository): Response
    {
        return $this->render('eleves/index.html.twig', [
            'eleves' => $elevesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eleves_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        ParentsRepository $parentsRepository
    ): Response {
        $elefe = new Eleves();
    
        // Vérifier si un parent est passé en paramètre
        if (!$request->query->has('parent_id')) {
            $this->addFlash('error', 'Un parent doit être associé à l\'élève. Veuillez d\'abord créer ou sélectionner un parent.');
            return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
        }
    
        // Pré-remplissage si un ID de parent est transmis
        $parent = $parentsRepository->find($request->query->get('parent_id'));
        if ($parent) {
            $elefe->setParent($parent);
        } else {
            $this->addFlash('error', 'Le parent spécifié n\'existe pas.');
            return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
        }
    
        $form = $this->createForm(ElevesType::class, $elefe);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($elefe);
            $entityManager->flush();
    
            $this->addFlash('success', 'L\'élève a été créé avec succès.');
            return $this->redirectToRoute('app_eleves_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('eleves/new.html.twig', [
            'eleve' => $elefe,
            'form'  => $form->createView(),
        ]);
    }
    
    #[Route('/{id}', name: 'app_eleves_show', methods: ['GET'])]
    public function show(Eleves $elefe): Response
    {
        return $this->render('eleves/show.html.twig', [
            'elefe' => $elefe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eleves_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eleves $elefe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ElevesType::class, $elefe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eleves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eleves/edit.html.twig', [
            'elefe' => $elefe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eleves_delete', methods: ['POST'])]
    public function delete(Request $request, Eleves $elefe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $elefe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($elefe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eleves_index', [], Response::HTTP_SEE_OTHER);
    }
}
