<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFiliereController extends AbstractController
{
    private array $filieres = [
        ['id' => 1, 'nom' => 'Génie Logiciel',                'duree' => '3 ans', 'debouches' => 'Développeur, Architecte'],
        ['id' => 2, 'nom' => 'Réseaux et Télécommunications', 'duree' => '3 ans', 'debouches' => 'Administrateur réseau'],
        ['id' => 3, 'nom' => 'Intelligence Artificielle',     'duree' => '3 ans', 'debouches' => 'Data Scientist, Ingénieur IA'],
        ['id' => 4, 'nom' => 'Cybersécurité',                 'duree' => '3 ans', 'debouches' => 'Expert sécurité'],
    ];

    #[Route('/admin/filieres', name: 'app_admin_filiere_index')]
    public function index(): Response
    {
        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $this->filieres,
        ]);
    }
}