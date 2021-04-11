<?php

use App\LawsuitModel;
use Illuminate\Database\Seeder;

class LawsuitModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models=[
            ["id" =>1, "procedure_id" =>1 ,"name"  => "Modèle Par Défaut: Assignation"],
            ["id" =>2, "procedure_id" =>2 ,"name"  => "Modèle Par Défaut: Nantissement (F.C)"],
            ["id" =>3, "procedure_id" =>3 ,"name"  => "Modèle Par Défaut: Commandement Immobilier"],
        ];
        foreach ($models as $model) {
            LawsuitModel::updateOrCreate(['id'=> $model['id']], $model);
        }

    }
}
