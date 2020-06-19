<?php

use Illuminate\Database\Seeder;
use App\RawMaterial;

class RawMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raw_materials = ['PET', 'PP', 'PPF', 'HIPS', 'LDPE', 'HDPE', 'PVC'];

        foreach($raw_materials as $raw_material){
            RawMaterial::create([
                'company_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'name' => $raw_material
            ]);    
        }
    }
}
