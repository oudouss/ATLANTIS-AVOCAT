<?php

use App\Procedure;
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

        $names=[
            "Assignation",
            "Nantissement (F.C)",
            "Commandement Immobilier",
            "Redressement Judiciaire",
        ];
        foreach ($names as $name) {
            $procedure=Procedure::where('name', $name)->firstOrFail();
            $lawsuitModel=LawsuitModel::updateOrCreate(
            ['procedure_id'=> $procedure->id],
            [
                "name"        => $name,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

    }
}
