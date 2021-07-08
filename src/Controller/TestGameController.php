<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestGameController extends AbstractController
{
    #[Route('/testing', name: 'test_game')]
    public function index(): Response
    {
        return $this->render('test_game/index.html.twig', [
            'controller_name' => 'TestGameController',
        ]);
    }
}
