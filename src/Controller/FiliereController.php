<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    private array $filieres = [
        [
            'id'          => 1,
            'nom'         => 'Génie Logiciel',
            'description' => 'Développement d\'applications et logiciels.',
            'details'     => 'Formation complète en conception et développement de logiciels.',
            'duree'       => '3 ans',
            'debouches'   => 'Développeur, Architecte logiciel',
        ],
        [
            'id'          => 2,
            'nom'         => 'Réseaux et Télécommunications',
            'description' => 'Gestion des réseaux informatiques.',
            'details'     => 'Installation, configuration et sécurité des réseaux.',
            'duree'       => '3 ans',
            'debouches'   => 'Administrateur réseau, Ingénieur télécom',
        ],
        [
            'id'          => 3,
            'nom'         => 'Intelligence Artificielle',
            'description' => 'Machine learning et systèmes intelligents.',
            'details'     => 'Algorithmes d\'apprentissage automatique et data science.',
            'duree'       => '3 ans',
            'debouches'   => 'Data Scientist, Ingénieur IA',
        ],
        [
            'id'          => 4,
            'nom'         => 'Cybersécurité',
            'description' => 'Protection des systèmes informatiques.',
            'details'     => 'Sécurité offensive et défensive, cryptographie.',
            'duree'       => '3 ans',
            'debouches'   => 'Expert sécurité, Pentesteur',
        ],
    ];

    #[Route('/filieres', name: 'app_filiere_index')]
    public function index(): Response
    {
        return $this->render('front/filiere/index.html.twig', [
            'filieres' => $this->filieres,
        ]);
    }

    #[Route('/filieres/{id}', name: 'app_filiere_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $filiere = null;
        foreach ($this->filieres as $f) {
            if ($f['id'] === $id) {
                $filiere = $f;
                break;
            }
        }

        if (!$filiere) {
            throw $this->createNotFoundException('Filière introuvable.');
        }

        return $this->render('front/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }
}