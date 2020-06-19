<?php

use Illuminate\Database\Seeder;
use App\RawMaterial;
use App\FmKutcha;

class FmKutchasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fm_kutcha_data = [
            ['company_id' => 1, 'created_by' => 1, 'updated_by' => 1, 'raw_material_id' => 1, 'name' => 'White'],
            ['company_id' => 1, 'created_by' => 1, 'updated_by' => 1, 'raw_material_id' => 1, 'name' => 'Red']
        ];

        foreach($fm_kutcha_data as $fm_kutcha){
            FmKutcha::create($fm_kutcha);        
        }
    }
}
