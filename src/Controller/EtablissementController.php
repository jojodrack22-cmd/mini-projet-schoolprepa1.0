<?php

namespace App\Controller;

use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'app_etablissement_index')]
    public function index(EtablissementRepository $repo): Response
    {
        return $this->render('front/etablissement/index.html.twig', [
            'etablissements' => $repo->findAll(),
        ]);
    }
}
