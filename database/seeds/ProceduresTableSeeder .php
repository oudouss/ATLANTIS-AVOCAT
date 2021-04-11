<?php

use App\Procedure;
use Illuminate\Database\Seeder;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedures=[
            ["id" =>1 ,"name"  => "Assignation"],
            ["id" =>2 ,"name"  => "Nantissement (F.C)"],
            ["id" =>3 ,"name"  => "Commandement Immobilier"],
        ];
        foreach ($procedures as $procedure) {
            Procedure::updateOrCreate(['id'=> $procedure['id']], $procedure);
        }
    }
}
