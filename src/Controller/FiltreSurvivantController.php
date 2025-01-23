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

            if(!empty($data['nom'])) {
                $survivants = $repository->findByName($data['nom']);
            }

            if(!empty($data['race']) && empty($data['power_min'])) {
                $survivants = $repository->findByRace($data['race']);
            }

            if(!empty($data['power_min'])) {
                $survivants = $repository->findByRaceAndPower(
                    $data['race'] ?? null, 
                    $data['power_min']
                );
            }
        }
       
        return $this->render('filtre_survivant/filtreSurvivant.html.twig', [
            'form' => $form->createView(),
            'survivants' => $survivants,
            
        ]);
    }
}
