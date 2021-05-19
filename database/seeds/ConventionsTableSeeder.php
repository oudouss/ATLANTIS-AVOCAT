<?php


use App\Convention;
use Illuminate\Database\Seeder;

class ConventionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conventions=[
            ["id" =>1 ,"name"  => "Convention CIH-2021: Commandement Immobilier(Hors Fogarim)", "type"=>0, "amount"=>null, "procedure_id" =>3],
            ["id" =>2 ,"name"  => "Convention CIH-2021: Assignation en paiement(Hors Fogarim)", "type"=>0, "amount"=>null, "procedure_id" =>1],
        ];
        foreach ($conventions as $convention) {
            Convention::updateOrCreate(['id'=> $convention['id']], $convention);
        }
    }
}
