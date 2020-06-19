<?php

use Illuminate\Database\Seeder;
use App\RawMaterial;
use App\SubRawMaterial;

class SubRawMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raw_materials = RawMaterial::all();
        $sub_raw_materials = ['RED', 'WHITE', 'ICE'];

        foreach($raw_materials as $raw_material){
            foreach($sub_raw_materials as $sub_raw_material){
                SubRawMaterial::create([
                    'company_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'raw_material_id' => $raw_material->id,
                    'name' => $sub_raw_material
                ]);        
            }
        }
    }
}
