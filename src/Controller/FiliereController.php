<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    #[Route('/filieres', name: 'filieres')]
    public function index()
    {
        $filieres = [
            [
                "nom" => "Génie Logiciel",
                "details" => "Cette filière forme des spécialistes en développement d'applications, conception de logiciels et gestion de projets informatiques."
            ],
            [
                "nom" => "Réseaux et Télécommunications",
                "details" => "Formation sur l'installation, la configuration et la sécurité des réseaux informatiques."
            ],
            [
                "nom" => "Intelligence Artificielle",
                "details" => "Étude du machine learning, data science et systèmes intelligents."
            ],
            [
                "nom" => "Cybersécurité",
                "details" => "Protection des données, sécurité des réseaux et lutte contre les cyberattaques."
            ]
        ];

        return $this->render('filiere/index.html.twig', [
            'filieres' => $filieres
        ]);
    }
}