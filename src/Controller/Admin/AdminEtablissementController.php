<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEtablissementController extends AbstractController
{
    private array $etablissements = [
        ['id' => 1, 'nom' => 'Université de Lomé', 'ville' => 'Lomé', 'type' => 'Université publique'],
        ['id' => 2, 'nom' => 'ESTIM',              'ville' => 'Lomé', 'type' => 'École privée'],
        ['id' => 3, 'nom' => 'ESGIS',              'ville' => 'Lomé', 'type' => 'Grande école'],
        ['id' => 4, 'nom' => 'INFA',               'ville' => 'Kara', 'type' => 'Institut public'],
    ];

    #[Route('/admin/etablissements', name: 'app_admin_etablissement_index')]
    public function index(): Response
    {
        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $this->etablissements,
        ]);
    }
}