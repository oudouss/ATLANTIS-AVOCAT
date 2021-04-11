<?php

use App\Honoraire;
use Illuminate\Database\Seeder;

class HonorairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $honoraires=[
            ["id" =>1 ,"convention_id"  => 1, "min_crc"=>10000, "max_crc" =>250000, "percent"  => 2.50, "min"=>4500, "max" =>6250],
            ["id" =>2 ,"convention_id"  => 1, "min_crc"=>250001, "max_crc" =>500000, "percent"  => 2.10, "min"=>6250, "max" =>10500],
            ["id" =>3 ,"convention_id"  => 1, "min_crc"=>500001, "max_crc" =>1000000, "percent"  => 1.60, "min"=>10500, "max" =>16000],
            ["id" =>4 ,"convention_id"  => 1, "min_crc"=>1000001, "max_crc" =>5000000, "percent"  => 1.10, "min"=>4500, "max" =>6250],
            ["id" =>5 ,"convention_id"  => 1, "min_crc"=>5000001, "max_crc" =>10000000, "percent"  => 0.90, "min"=>55000, "max" =>90000],
            ["id" =>6 ,"convention_id"  => 1, "min_crc"=>10000000, "max_crc" =>null, "percent"  => 0.60, "min"=>90000, "max" =>2000000],

            ["id" =>7 ,"convention_id"  => 2, "min_crc"=>10000, "max_crc" =>250000, "percent"  => 4.90, "min"=>5000, "max" =>12250],
            ["id" =>8 ,"convention_id"  => 2, "min_crc"=>250001, "max_crc" =>500000, "percent"  => 4.80, "min"=>12250, "max" =>24000],
            ["id" =>9 ,"convention_id"  => 2, "min_crc"=>500001, "max_crc" =>1000000, "percent"  => 3.60, "min"=>24000, "max" =>36000],
            ["id" =>10 ,"convention_id"  => 2, "min_crc"=>1000001, "max_crc" =>5000000, "percent"  => 3.00, "min"=>36000, "max" =>150000],
            ["id" =>11 ,"convention_id"  => 2, "min_crc"=>5000001, "max_crc" =>10000000, "percent"  => 2.30, "min"=>150000, "max" =>230000],
            ["id" =>12 ,"convention_id"  => 2, "min_crc"=>10000000, "max_crc" =>null, "percent"  => 1.20, "min"=>230000, "max" =>3000000],
        ];
        foreach ($honoraires as $honoraire) {
            Honoraire::updateOrCreate(['id'=> $honoraire['id']], $honoraire);
        }
    }
}
