<?php

namespace App\Controller;

use App\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'role' => 'host',
        ]);
    }

    public function guest(Session $session, $id):Response
    {
        $session->set('gameId', $id);
//        $form = $this->createForm(PlayerType::class);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'role'=>'guest',
            'id'=> $_GET['c']??null,
        ]);
    }


}
