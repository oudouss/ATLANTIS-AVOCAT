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
            ["id" =>1, "procedure_id" =>1 ,"name"  => "Assignation"],
            ["id" =>2, "procedure_id" =>2 ,"name"  => "Nantissement (F.C)"],
            ["id" =>3, "procedure_id" =>3 ,"name"  => "Commandement Immobilier"],
            ["id" =>4, "procedure_id" =>4 ,"name"  => "Redressement Judiciare"],
        ];
        foreach ($models as $model) {
            LawsuitModel::updateOrCreate(['id'=> $model['id']], $model);
        }

    }
}
