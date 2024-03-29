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
            ["convention_id"  => 1, "min_crc"=>10000, "max_crc" =>250000, "type"=>0, "amount"  => 2.50, "min"=>4500, "max" =>6250],
            ["convention_id"  => 1, "min_crc"=>250001, "max_crc" =>500000, "type"=>0, "amount"  => 2.10, "min"=>6250, "max" =>10500],
            ["convention_id"  => 1, "min_crc"=>500001, "max_crc" =>1000000, "type"=>0, "amount"  => 1.60, "min"=>10500, "max" =>16000],
            ["convention_id"  => 1, "min_crc"=>1000001, "max_crc" =>5000000, "type"=>0, "amount"  => 1.10, "min"=>4500, "max" =>6250],
            ["convention_id"  => 1, "min_crc"=>5000001, "max_crc" =>10000000, "type"=>0, "amount"  => 0.90, "min"=>55000, "max" =>90000],
            ["convention_id"  => 1, "min_crc"=>10000000, "max_crc" =>null, "type"=>0, "amount"  => 0.60, "min"=>90000, "max" =>2000000],

            ["convention_id"  => 2, "min_crc"=>10000, "max_crc" =>250000, "type"=>0, "amount"  => 4.90, "min"=>5000, "max" =>12250],
            ["convention_id"  => 2, "min_crc"=>250001, "max_crc" =>500000, "type"=>0, "amount"  => 4.80, "min"=>12250, "max" =>24000],
            ["convention_id"  => 2, "min_crc"=>500001, "max_crc" =>1000000, "type"=>0, "amount"  => 3.60, "min"=>24000, "max" =>36000],
            ["convention_id"  => 2, "min_crc"=>1000001, "max_crc" =>5000000, "type"=>0, "amount"  => 3.00, "min"=>36000, "max" =>150000],
            ["convention_id"  => 2, "min_crc"=>5000001, "max_crc" =>10000000, "type"=>0, "amount"  => 2.30, "min"=>150000, "max" =>230000],
            ["convention_id"  => 2, "min_crc"=>10000000, "max_crc" =>null, "type"=>0, "amount"  => 1.20, "min"=>230000, "max" =>3000000],
        ];
        foreach ($honoraires as $honoraire) {
            Honoraire::updateOrCreate(
            ['convention_id'=> $honoraire['convention_id'], 'min_crc'=> $honoraire['min_crc'], 'max_crc'=> $honoraire['max_crc']],
            [
                'type'=> $honoraire['type'],
                'amount'=> $honoraire['amount'],
                'min'=> $honoraire['min'],
                'max'=> $honoraire['max'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
