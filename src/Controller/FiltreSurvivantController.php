<?php

namespace App\Controller;

use App\Form\FilterType;
use App\Repository\SurvivantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FiltreSurvivantController extends AbstractController
{
    #[Route('/filtre/survivant', name: 'app_filtre_survivant')]
    public function index(SurvivantRepository $repository, Request $request): Response
    {
       
        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);

        $survivants = $repository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
    
            // Construire un tableau de filtres à partir des données du formulaire
            $filters = [
                'nom' => $data['nom'] ?? null,
                'race' => $data['race'] ?? null,
                'power_min' => $data['power_min'] ?? null,
                'classe' => $data['classe'] ?? null
            ];
    
            // Appeler la méthode findByFilters du repository
            $survivants = $repository->findByFilters($filters);
        }
       
        return $this->render('filtre_survivant/filtreSurvivant.html.twig', [
            'form' => $form->createView(),
            'survivants' => $survivants,
            
        ]);
    }
}
