<?php

namespace App\Controller;

use App\Service\GenerateLobbyId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class LobbyController extends AbstractController
{

    public function index(Session $session): Response
    {
        return $this->render('lobby/index.html.twig', [
            'controller_name' => 'LobbyController',
            'gameId' => $session->get('gameId'),
        ]);
    }

    public function setup(Session $session, GenerateLobbyId $lobbyId): Response
    {
        $session->set('gameId', $lobbyId->generateLobbyId());
        return $this->redirectToRoute("lobby");
    }

    public function join(Session $session): Response
    {
        $session->get('gameId');
        return $this->redirectToRoute("lobby");
    }
}
