<?php

namespace App\Controller;


use App\Repository\SurvivantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PowerController extends AbstractController
{
    #[Route('/power', name: 'app_power')]
    public function index(SurvivantRepository $repository): Response
    {     

        $totalRacePower = $repository->totalRacePower();
        
        return $this->render('power/power.html.twig', [
           'totalRacePower' => $totalRacePower,
        ]);
    }
}
