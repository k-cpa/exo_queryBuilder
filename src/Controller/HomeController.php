<?php

namespace App\Controller;

use App\Repository\SurvivantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SurvivantRepository $repository): Response
    {

        $survivants = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'survivants' => $survivants,
        ]);
    }
}
