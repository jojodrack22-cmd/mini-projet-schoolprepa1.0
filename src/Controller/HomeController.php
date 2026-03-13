<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index()
    {
        $filieres = [
            [
                "nom" => "Génie Logiciel",
                "description" => "Développement d'applications et logiciels."
            ],
            [
                "nom" => "Réseaux et Télécommunications",
                "description" => "Gestion des réseaux informatiques."
            ],
            [
                "nom" => "Intelligence Artificielle",
                "description" => "Machine learning et systèmes intelligents."
            ],
            [
                "nom" => "Cybersécurité",
                "description" => "Protection des systèmes informatiques."
            ]
        ];

        return $this->render('home/index.html.twig', [
            'filieres' => $filieres
        ]);
    }
}
