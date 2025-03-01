<?php

namespace App\Controller;

use App\Entity\Peres;
use App\Form\PeresType;
use App\Data\SearchData;
use App\Form\SearchDataType;
use App\Repository\ElevesRepository;
use App\Repository\PeresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/peres')]
final class PeresController extends AbstractController
{
    #[Route(name: 'app_peres_index', methods: ['GET'])]
    public function index(Request $request, PeresRepository $peresRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchDataType::class, $data);
        $form->handleRequest($request);
        $peres = $peresRepository->findBySearchData($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les résultats filtrés en utilisant le repository
            $peres = $peresRepository->findBySearchData($data);
        } else {
            // Récupérer tous les résultats si aucun critère de recherche n'est fourni
            $peres = $peresRepository->findAll();
        }

        return $this->render('peres/index.html.twig', [
            'peres' => $peres,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_peres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pere = new Peres();
        $form = $this->createForm(PeresType::class, $pere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pere);
            $entityManager->flush();

            return $this->redirectToRoute('app_peres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('peres/new.html.twig', [
            'pere' => $pere,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_peres_show', methods: ['GET'])]
    public function show(Peres $pere, ElevesRepository $elevesRepository): Response
    {
        $eleves = $elevesRepository->findByPere($pere);
        return $this->render('peres/show.html.twig', [
            'pere' => $pere,
            'eleves' => $eleves,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_peres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Peres $pere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PeresType::class, $pere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_peres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('peres/edit.html.twig', [
            'pere' => $pere,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_peres_delete', methods: ['POST'])]
    public function delete(Request $request, Peres $pere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($pere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_peres_index', [], Response::HTTP_SEE_OTHER);
    }
}
