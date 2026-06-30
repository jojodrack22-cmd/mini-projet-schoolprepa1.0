<?php

namespace App\Controller\Admin;

use App\Repository\EtablissementRepository;
use App\Repository\EvenementRepository;
use App\Repository\FiliereRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
        FiliereRepository $filiereRepo,
        EtablissementRepository $etablissementRepo,
        EvenementRepository $evenementRepo,
        UserRepository $userRepo,
    ): Response {
        return $this->render('admin/dashboard.html.twig', [
            'nbFilieres'       => $filiereRepo->count([]),
            'nbEtablissements' => $etablissementRepo->count([]),
            'nbEvenements'     => $evenementRepo->count([]),
            'nbUsers'          => $userRepo->count([]),
        ]);
    }
}
