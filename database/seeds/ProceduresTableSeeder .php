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
        $names=[
            "Assignation",
            "Nantissement (F.C)",
            "Commandement Immobilier",
            "Redressement Judiciaire",
        ];
        foreach ($names as $name) {
            $procedure=Procedure::updateOrCreate(
            ['name'=> $name],
            [
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
