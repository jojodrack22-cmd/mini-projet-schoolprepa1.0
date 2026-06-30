<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    #[Route('/filieres', name: 'app_filiere_index')]
    public function index(FiliereRepository $repo): Response
    {
        return $this->render('front/filiere/index.html.twig', [
            'filieres' => $repo->findAll(),
        ]);
    }

    #[Route('/filieres/{id}', name: 'app_filiere_show', requirements: ['id' => '\d+'])]
    public function show(int $id, FiliereRepository $repo): Response
    {
        $filiere = $repo->find($id);

        if (!$filiere) {
            throw $this->createNotFoundException('Filière introuvable.');
        }

        return $this->render('front/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }
}
