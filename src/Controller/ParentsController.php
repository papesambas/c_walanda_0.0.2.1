<?php

namespace App\Controller;

use App\Entity\Parents;
use App\Data\SearchData;
use App\Form\ParentsType;
use App\Form\SearchDataType;
use App\Data\SearchParentData;
use App\Form\SearchParentDataType;
use App\Repository\MeresRepository;
use App\Repository\PeresRepository;
use App\Repository\ParentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/parents')]
final class ParentsController extends AbstractController
{
    #[Route(name: 'app_parents_index', methods: ['GET'])]
    public function index(
        Request $request,
        PeresRepository $peresRepository,
        MeresRepository $meresRepository,
        ParentsRepository $parentsRepository
    ): Response {
        $data = new SearchParentData();
        $form = $this->createForm(SearchParentDataType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Recherche pour le père
            $peres = $peresRepository->findBySearchParentData($data);
            // Recherche pour la mère
            $meres = $meresRepository->findBySearchParentData($data);

            if (!empty($peres) && !empty($meres)) {
                // On prend le premier résultat de chaque recherche
                $parent = $parentsRepository->findOneByPereAndMere($peres[0], $meres[0]);
                return $this->redirectToRoute('app_parents_show', ['id' => $parent->getId()]);
            } elseif (!empty($peres) && empty($meres)) {
                // Rediriger vers la création d'un nouveau parent avec le père pré-rempli
                return $this->redirectToRoute('app_parents_new', [
                    'pere_id' => $peres[0]->getId(),
                ], Response::HTTP_SEE_OTHER);
            } elseif (empty($peres) && !empty($meres)) {
                // Rediriger vers la création d'un nouveau parent avec la mère pré-remplie
                return $this->redirectToRoute('app_parents_new', [
                    'mere_id' => $meres[0]->getId(),
                ], Response::HTTP_SEE_OTHER);
            } else {
                // Aucun résultat pour père et mère, rediriger vers le formulaire de création vide
                return $this->redirectToRoute('app_parents_new', [], Response::HTTP_SEE_OTHER);
            }
        }

        // Aucun critère de recherche, on affiche tous les parents (ou le formulaire)
        $parents = $parentsRepository->findAll();

        return $this->render('parents/index.html.twig', [
            'parents' => $parents,
            'form'    => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_parents_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        ParentsRepository $parentsRepository,
        PeresRepository $peresRepository,
        MeresRepository $meresRepository
    ): Response {
        $parent = new Parents();

        // Pré-remplissage si un ID de père est transmis
        if ($request->query->has('pere_id')) {
            $pere = $peresRepository->find($request->query->get('pere_id'));
            if ($pere) {
                $parent->setPere($pere);
            }
        }

        // Pré-remplissage si un ID de mère est transmis
        if ($request->query->has('mere_id')) {
            $mere = $meresRepository->find($request->query->get('mere_id'));
            if ($mere) {
                $parent->setMeres($mere);
            }
        }

        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parentsRepository->add($parent); // ou persist/flush selon votre configuration
            return $this->redirectToRoute('app_parents_show', ['id' => $parent->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents/new.html.twig', [
            'parent' => $parent,
            'form'   => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_show', methods: ['GET'])]
    public function show(Parents $parent): Response
    {
        return $this->render('parents/show.html.twig', [
            'parent' => $parent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parents $parent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents/edit.html.twig', [
            'parent' => $parent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_delete', methods: ['POST'])]
    public function delete(Request $request, Parents $parent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $parent->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
    }
}
