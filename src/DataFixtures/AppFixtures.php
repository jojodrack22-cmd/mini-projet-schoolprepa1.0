<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use App\Entity\Evenement;
use App\Entity\Filiere;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // --- Filières ---
        $filiereData = [
            ['Génie Logiciel',                '3 ans', 'Formation en conception et développement de logiciels, architecture logicielle et génie des exigences.'],
            ['Réseaux et Télécommunications', '3 ans', 'Conception, installation et sécurité des réseaux informatiques et systèmes de télécommunication.'],
            ['Intelligence Artificielle',     '3 ans', 'Apprentissage automatique, traitement du langage naturel et vision par ordinateur.'],
            ['Cybersécurité',                 '3 ans', 'Sécurité offensive et défensive, audit, cryptographie et gestion des incidents.'],
            ['Développement Web & Mobile',    '2 ans', 'Conception d\'applications web et mobiles avec les technologies modernes.'],
            ['Data Science & Big Data',       '3 ans', 'Analyse de données massives, statistiques avancées et visualisation.'],
        ];

        $filieres = [];
        foreach ($filiereData as [$nom, $duree, $desc]) {
            $f = new Filiere();
            $f->setNom($nom)->setDuree($duree)->setDescription($desc);
            $manager->persist($f);
            $filieres[] = $f;
        }

        // --- Établissements ---
        $etablissementData = [
            ['Université de Lomé',              'Lomé',     'Université publique',  'ul@ul.tg'],
            ['ESTIM',                           'Lomé',     'École privée',         'contact@estim.tg'],
            ['ESGIS',                           'Lomé',     'Grande école',         'info@esgis.tg'],
            ['Institut National de Formation',  'Kara',     'Institut public',      'infa@gouv.tg'],
            ['iP Net Institute of Technology',  'Lomé',     'École privée',         'info@ipnet.tg'],
            ['École Supérieure de Commerce',    'Atakpamé', 'Grande école',         'esc@esc.tg'],
        ];

        $etablissements = [];
        foreach ($etablissementData as $i => [$nom, $ville, $type, $contact]) {
            $e = new Etablissement();
            $e->setNom($nom)->setVille($ville)->setType($type)->setContact($contact);

            if ($nom === 'iP Net Institute of Technology') {
                // iP Net propose toutes les filières
                foreach ($filieres as $f) {
                    $e->addFiliere($f);
                }
            } else {
                $e->addFiliere($filieres[$i % count($filieres)]);
                $e->addFiliere($filieres[($i + 1) % count($filieres)]);
            }

            $manager->persist($e);
            $etablissements[] = $e;
        }

        // --- Événements ---
        $evenementData = [
            ['Journée Portes Ouvertes',          '2026-09-15 09:00', 'Lomé',      'Découvrez nos formations et rencontrez nos enseignants.'],
            ['Conférence IA & Avenir',           '2026-10-05 14:00', 'Lomé',      'Conférence sur l\'intelligence artificielle et les métiers de demain.'],
            ['Hackathon SchoolPrepar',           '2026-11-20 08:00', 'Lomé',      '48h de coding pour résoudre des problèmes réels avec la technologie.'],
            ['Forum des Métiers du Numérique',   '2026-09-28 10:00', 'Kara',      'Rencontrez des professionnels du secteur numérique togolais.'],
            ['Cérémonie de Remise de Diplômes',  '2026-12-10 10:00', 'Lomé',      'Célébration de la promotion 2025-2026.'],
            ['Atelier Cybersécurité',            '2026-10-18 13:00', 'Lomé',      'Initiation pratique aux outils de sécurité informatique.'],
        ];

        foreach ($evenementData as $i => [$titre, $date, $lieu, $desc]) {
            $ev = new Evenement();
            $ev->setTitre($titre)
               ->setDateEvenement(new \DateTime($date))
               ->setLieu($lieu)
               ->setDescription($desc)
               ->setEtablissement($etablissements[$i % count($etablissements)]);
            $manager->persist($ev);
        }

        // --- Utilisateurs ---
        $admin = new User();
        $admin->setEmail('admin@schoolprepar.tg')
              ->setRoles(['ROLE_ADMIN'])
              ->setPassword($this->hasher->hashPassword($admin, 'Admin1234!'));
        $manager->persist($admin);

        $usersData = [
            ['etudiant1@schoolprepar.tg', 'Pass1234!'],
            ['etudiant2@schoolprepar.tg', 'Pass1234!'],
            ['etudiant3@schoolprepar.tg', 'Pass1234!'],
            ['etudiant4@schoolprepar.tg', 'Pass1234!'],
            ['enseignant@schoolprepar.tg', 'Pass1234!'],
        ];

        foreach ($usersData as [$email, $pass]) {
            $u = new User();
            $u->setEmail($email)->setRoles(['ROLE_USER'])
              ->setPassword($this->hasher->hashPassword($u, $pass));
            $manager->persist($u);
        }

        $manager->flush();
    }
}
