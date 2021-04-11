<?php

use App\Modalite;
use Illuminate\Database\Seeder;

class ModalitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modalites=[
            ["id" =>1 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"Dépôt de la demande de notification du C.I", "type"  => 0, "amount"=>20, "days" =>8, "tax"=>10, "stade_name_id" =>16],
            ["id" =>2 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"Réception du certificat de propriété indiquant l'inscription du C.I", "type"  => 0, "amount"=>10, "days" =>8, "tax"=>10, "stade_name_id" =>17],
            ["id" =>3 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"Notification du C.I au Client", "type"  => 0, "amount"=>10, "days" =>8, "tax"=>10, "stade_name_id" =>18],
            ["id" =>4 ,"convention_id"  => 1, "bill_type"=>"option3", "name" =>"Notification au curateur", "type"  => 1, "amount"=>1500, "days" =>8, "tax"=>null, "stade_name_id" =>19],
            ["id" =>5 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"Dépot du rapport d'expertise immobilière", "type"  => 0, "amount"=>10, "days" =>8, "tax"=>10, "stade_name_id" =>22],
            ["id" =>6 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"1ère Mise en Vente Immobilière", "type"  => 0, "amount"=>20, "days" =>8, "tax"=>10, "stade_name_id" =>24],
            ["id" =>7 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"3ème Mise en Vente Immobilière", "type"  => 0, "amount"=>30, "days" =>8, "tax"=>10, "stade_name_id" =>25],
            ["id" =>8 ,"convention_id"  => 1, "bill_type"=>"option2", "name" =>"4ème Mise en Vente Immobilière", "type"  => 1, "amount"=>500, "days" =>8, "tax"=>10, "stade_name_id" =>26],

            ["id" =>9 ,"convention_id"  => 2, "bill_type"=>"option2", "name" =>"Dépot de la requête", "type"  => 0, "amount"=>20, "days" =>8, "tax"=>10, "stade_name_id" =>1],
            ["id" =>10 ,"convention_id"  => 2, "bill_type"=>"option2", "name" =>"Prononcé du jugement de 1ère instance", "type"  => 0, "amount"=>20, "days" =>8, "tax"=>10, "stade_name_id" =>5],
            ["id" =>11 ,"convention_id"  => 2, "bill_type"=>"option2", "name" =>"Prononcé de l'arrêt d'appel | Production d'un certificat de non opposition ou Appel", "type"  => 0, "amount"=>20, "days" =>8, "tax"=>10, "stade_name_id" =>6],
            ["id" =>12 ,"convention_id"  => 2, "bill_type"=>"option2", "name" =>"Production d'un PV d'exécution du jugement ou de l'arrêt", "type"  => 0, "amount"=>40, "days" =>8, "tax"=>10, "stade_name_id" =>7],
        ];
        foreach ($modalites as $modalite) {
            Modalite::updateOrCreate(['id'=> $modalite['id']], $modalite);
        }
    }
}
