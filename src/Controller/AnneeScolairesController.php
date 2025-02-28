<?php

namespace App\Controller;

use App\Entity\AnneeScolaires;
use App\Form\AnneeScolairesType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use App\Repository\AnneeScolairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/annee/scolaires')]
final class AnneeScolairesController extends AbstractController
{
    #[Route(name: 'app_annee_scolaires_index', methods: ['GET'])]
    public function index(AnneeScolairesRepository $anneeScolairesRepository): Response
    {
        return $this->render('annee_scolaires/index.html.twig', [
            'annee_scolaires' => $anneeScolairesRepository->findAll(['anneeDebut' => 'ASC']),
        ]);
    }
    
    #[Route('/new', name: 'app_annee_scolaires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $anneeScolaire = new AnneeScolaires();
        
        // Déterminer l'année scolaire en fonction du mois actuel
        $currentYear = (int) (new \DateTime())->format('Y');
        $currentMonth = (int) (new \DateTime())->format('m');
        $anneeDebut = ($currentMonth >= 8) ? $currentYear : $currentYear - 1;
        $anneeScolaire->setAnneeDebut($anneeDebut);
        $anneeScolaire->setAnneeFin($anneeDebut + 1);
    
        // Création du formulaire
        $form = $this->createForm(AnneeScolairesType::class, $anneeScolaire);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
            $submittedAnneeDebut = $anneeScolaire->getAnneeDebut();
            $existingAnneeScolaire = $entityManager->getRepository(AnneeScolaires::class)
                ->findOneBy(['anneeDebut' => $submittedAnneeDebut]);
    
            if ($existingAnneeScolaire) {
                $form->get('anneeDebut')->addError(new FormError('Cette année existe déjà.'));
            }
    
            if ($form->isValid()) {
                // Sauvegarde en base de données
                $anneeScolaire->setAnneeFin($submittedAnneeDebut + 1);
                $entityManager->persist($anneeScolaire);
                $entityManager->flush();
    
                // Si c'est une requête AJAX, on renvoie une réponse JSON
                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse(['success' => true], Response::HTTP_OK);
                }
    
                return $this->redirectToRoute('app_annee_scolaires_index');
            } else {
                // Si c'est une requête AJAX, renvoyer les erreurs en JSON
                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse([
                        'success' => false,
                        'errors' => $this->getFormErrors($form)
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            }
        }
    
        return $this->render('annee_scolaires/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * Fonction pour récupérer les erreurs du formulaire sous forme de tableau JSON
     */
    private function getFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[$error->getOrigin()->getName()][] = $error->getMessage();
        }
        return $errors;
    }
    
    #[Route('/{id}', name: 'app_annee_scolaires_show', methods: ['GET'])]
    public function show(AnneeScolaires $anneeScolaire): Response
    {
        return $this->render('annee_scolaires/show.html.twig', [
            'annee_scolaire' => $anneeScolaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annee_scolaires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnneeScolaires $anneeScolaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnneeScolairesType::class, $anneeScolaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_scolaires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annee_scolaires/edit.html.twig', [
            'annee_scolaire' => $anneeScolaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annee_scolaires_delete', methods: ['POST'])]
    public function delete(Request $request, AnneeScolaires $anneeScolaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $anneeScolaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($anneeScolaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annee_scolaires_index', [], Response::HTTP_SEE_OTHER);
    }
}
