<?php

use App\StadeName;
use Illuminate\Database\Seeder;

class StadeNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stades=[
            // Assignation
            ["name"  => "A0: Affectation Dossier (M.E.D)", "days" =>null],
            ["name"  => "A1: Audience", "days" =>15],
            ["name"  => "A2: Jugement A.D.D", "days" =>45],
            ["name"  => "A3: Expertise Comptable", "days" =>60],
            ["name"  => "A4: Prononcé du Jugement", "days" =>90],
            ["name"  => "A5: Jugement DEFAVORABLE", "days" =>95],
            ["name"  => "A6: Demande Notification et Execution (F.C)", "days" =>140],

            // Nantissement (F.C)
            ["name"  => "B0: Affectation Dossier", "days" =>null],
            ["name"  => "B1: Dépôt de requêtte: Réalisation du Nantissement F.C (art 114 CC-Nouveau)", "days" =>null],
            ["name"  => "B2: Notification et Exécution", "days" =>null],
            ["name"  => "B3: Procédure Curateur", "days" =>null],
            ["name"  => "B4: Publication", "days" =>null],
            ["name"  => "B5: Expertise Mobilière", "days" =>null],
            ["name"  => "B6: Rapport Expertise Mobilière", "days" =>null],
            ["name"  => "B7: 1ère Mise en Vente (F.C)", "days" =>null],

            // Commandement Immobilier
            ["name"  => "C0: Affectation Dossier", "days" =>null],
            ["name"  => "C1: Dépôt CI", "days" =>15],
            ["name"  => "C2: Notification et Exécution CI", "days" =>45],
            ["name"  => "C3: Procédure Curateur", "days" =>150],
            ["name"  => "C4: Publication CI", "days" =>87],
            ["name"  => "C5: Expertise Immobilière", "days" =>117],
            ["name"  => "C6: Rapport Expertise Immobilière", "days" =>147],
            ["name"  => "C7: 1ère Mise en Vente Immobilière", "days" =>180],
            ["name"  => "C7: 2ème Mise en Vente Immobilière", "days" =>null],
            ["name"  => "C7: 3ème Mise en Vente Immobilière", "days" =>null],
            ["name"  => "C7: 4ème Mise en Vente Immobilière", "days" =>null],

            // Redressement judiciare
            ["name"  => "R0: Affectation", "days" =>null],
            ["name"  => "R1: Vérification de Créance", "days" =>null],
            ["name"  => "R2: Ordonnance de Redressement", "days" =>null],
            ["name"  => "R3: Intervention du Syndique", "days" =>null],
            ["name"  => "R4: Rapport du Syndique", "days" =>null],
            ["name"  => "R5: Décision du Juge", "days" =>null],
        ];
        foreach ($stades as $stade) {
            $stadeName=StadeName::updateOrCreate(
            ['name'=> $stade['name']],
            [
                'days'  => $stade['days'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

    }
}
