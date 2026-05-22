<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'app_etablissement_index')]
    public function index(): Response
    {
        $etablissements = [
            ['id' => 1, 'nom' => 'Université de Lomé', 'ville' => 'Lomé', 'type' => 'Université publique'],
            ['id' => 2, 'nom' => 'ESTIM',              'ville' => 'Lomé', 'type' => 'École privée'],
            ['id' => 3, 'nom' => 'ESGIS',              'ville' => 'Lomé', 'type' => 'Grande école'],
            ['id' => 4, 'nom' => 'INFA',               'ville' => 'Kara', 'type' => 'Institut public'],
        ];

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }
}