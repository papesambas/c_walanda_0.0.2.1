<?php

namespace App\Controller;

use App\Entity\Meres;
use App\Form\MeresType;
use App\Data\SearchData;
use App\Form\SearchDataType;
use App\Repository\ElevesRepository;
use App\Repository\MeresRepository;
use App\Repository\ParentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/meres')]
final class MeresController extends AbstractController
{
    #[Route(name: 'app_meres_index', methods: ['GET'])]
    public function index(Request $request, MeresRepository $meresRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchDataType::class, $data);
        $form->handleRequest($request);
        $meres = $meresRepository->findBySearchData($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les résultats filtrés en utilisant le repository
            $meres = $meresRepository->findBySearchData($data);
        } else {
            // Récupérer tous les résultats si aucun critère de recherche n'est fourni
            $meres = $meresRepository->findAll();
        }

        return $this->render('meres/index.html.twig', [
            'meres' => $meres,
            'form' => $form->createView(),
        ]);

    }

    #[Route('/new', name: 'app_meres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mere = new Meres();
        $form = $this->createForm(MeresType::class, $mere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mere);
            $entityManager->flush();

            return $this->redirectToRoute('app_meres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meres/new.html.twig', [
            'mere' => $mere,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_meres_show', methods: ['GET'])]
    public function show(Meres $mere, ElevesRepository $elevesRepository): Response
    {
        $eleves = $elevesRepository->findByMere($mere);
        return $this->render('meres/show.html.twig', [
            'mere' => $mere,
            'eleves' => $eleves,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_meres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Meres $mere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MeresType::class, $mere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_meres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meres/edit.html.twig', [
            'mere' => $mere,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_meres_delete', methods: ['POST'])]
    public function delete(Request $request, Meres $mere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($mere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_meres_index', [], Response::HTTP_SEE_OTHER);
    }
}
