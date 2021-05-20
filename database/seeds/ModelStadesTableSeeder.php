<?php

use App\ModelStade;
use Illuminate\Database\Seeder;

class ModelStadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modelStades=[
            // Assignation
            ["id" =>1, "first" =>1, "last" =>0, "model_id"  =>1, "current_id"  =>1, "previous_id"  => null, "next_id" =>2],
            ["id" =>2, "first" =>0, "last" =>0, "model_id"  =>1, "current_id"  =>2, "previous_id"  => 1, "next_id" =>3],
            ["id" =>3, "first" =>0, "last" =>0, "model_id"  =>1, "current_id"  =>3 , "previous_id"  => 2, "next_id" =>4],
            ["id" =>4, "first" =>0, "last" =>0, "model_id"  =>1, "current_id"  =>4 , "previous_id"  => 3, "next_id" =>5],
            ["id" =>5, "first" =>0, "last" =>0, "model_id"  =>1, "current_id"  =>5 , "previous_id"  => 4, "next_id" =>7],
            ["id" =>6, "first" =>0, "last" =>1, "model_id"  =>1, "current_id"  =>7 , "previous_id"  => 5, "next_id" =>null],

            // Nantissement (F.C)
            ["id" =>8, "first" =>1, "last" =>0, "model_id"  =>2,  "current_id"  =>8, "previous_id"  => null, "next_id" =>9],
            ["id" =>9, "first" =>0, "last" =>0, "model_id"  =>2, "current_id"  =>9, "previous_id"  => 8, "next_id" =>10],
            ["id" =>10, "first" =>0, "last" =>0, "model_id"  =>2, "current_id"  =>10, "previous_id"  => 19, "next_id" =>12],
            // ["id" =>12, "first" =>0, "last" =>0, "model_id"  =>2, "current_id"  =>11, "previous_id"  => 10, "next_id" =>12],Currateur
            ["id" =>11, "first" =>0, "last" =>0, "model_id"  =>2, "current_id"  =>12, "previous_id"  => 10, "next_id" =>13],
            ["id" =>12, "first" =>0, "last" =>0, "model_id"  =>2, "current_id"  =>13, "previous_id"  => 12, "next_id" =>14],
            ["id" =>13, "first" =>0, "last" =>0, "model_id"  =>2, "current_id"  =>14, "previous_id"  => 13, "next_id" =>15],
            ["id" =>14, "first" =>0, "last" =>1, "model_id"  =>2, "current_id"  =>15, "previous_id"  => 14, "next_id" =>null],
            
            // Commandement Immobilier
            ["id" =>15, "first" =>1, "last" =>0, "model_id"  =>3, "current_id" =>16 , "previous_id"  => null, "next_id" =>17],
            ["id" =>16, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>17 , "previous_id"  => 16, "next_id" =>18],
            ["id" =>17, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>18 , "previous_id"  => 17, "next_id" =>20],
            // ["id" =>20, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>19, "previous_id"  => 18, "next_id" =>21],Currateur
            ["id" =>18, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>20, "previous_id"  => 19, "next_id" =>21],
            ["id" =>19, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>21, "previous_id"  => 20, "next_id" =>22],
            ["id" =>20, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>22, "previous_id"  => 21, "next_id" =>23],
            ["id" =>21, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>23, "previous_id"  => 22, "next_id" =>24],
            ["id" =>22, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>24, "previous_id"  => 23, "next_id" =>25],
            ["id" =>23, "first" =>0, "last" =>0, "model_id"  =>3, "current_id" =>25, "previous_id"  => 24, "next_id" =>26],
            ["id" =>24, "first" =>0, "last" =>1, "model_id"  =>3, "current_id" =>26, "previous_id"  => 25, "next_id" =>null],

            // Redressement judiciare
            ["id" =>25, "first" =>1, "last" =>0, "model_id"  =>4, "current_id" =>27 , "previous_id"  => null, "next_id" =>28],
            ["id" =>26, "first" =>0, "last" =>0, "model_id"  =>4, "current_id" =>28 , "previous_id"  => 27, "next_id" =>29],
            ["id" =>27, "first" =>0, "last" =>0, "model_id"  =>4, "current_id" =>29 , "previous_id"  => 28, "next_id" =>30],
            ["id" =>28, "first" =>0, "last" =>0, "model_id"  =>4, "current_id" =>30, "previous_id"  => 29, "next_id" =>31],
            ["id" =>29, "first" =>0, "last" =>0, "model_id"  =>4, "current_id" =>31, "previous_id"  => 30, "next_id" =>32],
            ["id" =>30, "first" =>0, "last" =>1, "model_id"  =>4, "current_id" =>32, "previous_id"  => 31, "next_id" =>null],

        ];
        foreach ($modelStades as $modelStade) {
            ModelStade::updateOrCreate(['id'=> $modelStade['id']], $modelStade);
        }

    }
}
