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
            ["id" =>1 ,"name"  => "A0: Affectation Dossier (M.E.D)", "days" =>null],
            ["id" =>2 ,"name"  => "A1: Audience", "days" =>15],
            ["id" =>3 ,"name"  => "A2: Jugement A.D.D", "days" =>45],
            ["id" =>4 ,"name"  => "A3: Expertise Comptable", "days" =>60],
            ["id" =>5 ,"name"  => "A4: Prononcé du Jugement", "days" =>90],
            ["id" =>6 ,"name"  => "A5: Jugement DEFAVORABLE", "days" =>95],
            ["id" =>7 ,"name"  => "A6: Demande Notification et Execution (F.C)", "days" =>140],

            // Nantissement (F.C)
            ["id" =>8 ,"name"  => "B0: Affectation Dossier", "days" =>null],
            ["id" =>9 ,"name"  => "B1: Dépôt de requêtte: Réalisation du Nantissement F.C (art 114 CC-Nouveau)", "days" =>null],
            ["id" =>10 ,"name"  => "B2: Notification et Exécution", "days" =>null],
            ["id" =>11 ,"name"  => "B3: Procédure Curateur", "days" =>null],
            ["id" =>12 ,"name"  => "B4: Publication", "days" =>null],
            ["id" =>13 ,"name"  => "B5: Expertise Mobilière", "days" =>null],
            ["id" =>14 ,"name"  => "B6: Rapport Expertise Mobilière", "days" =>null],
            ["id" =>15 ,"name"  => "B7: 1ère Mise en Vente (F.C)", "days" =>null],

            // Commandement Immobilier
            ["id" =>16 ,"name"  => "C0: Affectation Dossier", "days" =>null],
            ["id" =>17 ,"name"  => "C1: Dépôt CI", "days" =>15],
            ["id" =>18 ,"name"  => "C2: Notification et Exécution CI", "days" =>45],
            ["id" =>19 ,"name"  => "C3: Procédure Curateur", "days" =>150],
            ["id" =>20 ,"name"  => "C4: Publication CI", "days" =>87],
            ["id" =>21 ,"name"  => "C5: Expertise Immobilière", "days" =>117],
            ["id" =>22 ,"name"  => "C6: Rapport Expertise Immobilière", "days" =>147],
            ["id" =>23 ,"name"  => "C7: 1ère Mise en Vente Immobilière", "days" =>180],
            ["id" =>24 ,"name"  => "C7: 2ème Mise en Vente Immobilière", "days" =>null],
            ["id" =>25 ,"name"  => "C7: 3ème Mise en Vente Immobilière", "days" =>null],
            ["id" =>26 ,"name"  => "C7: 4ème Mise en Vente Immobilière", "days" =>null],

            // Redressement judiciare
            ["id" =>27 ,"name"  => "R0: Affectation", "days" =>null],
            ["id" =>28 ,"name"  => "R1: Vérification de Créance", "days" =>null],
            ["id" =>29 ,"name"  => "R2: Ordonnance de Redressement", "days" =>null],
            ["id" =>30 ,"name"  => "R3: Intervention du Syndique", "days" =>null],
            ["id" =>31 ,"name"  => "R4: Rapport du Syndique", "days" =>null],
            ["id" =>32 ,"name"  => "R5: Décision du Juge", "days" =>null],
        ];
        foreach ($stades as $stade) {
            StadeName::updateOrCreate(['id'=> $stade['id']], $stade);
        }

    }
}
