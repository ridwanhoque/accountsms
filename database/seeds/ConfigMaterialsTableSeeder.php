<?php

use Illuminate\Database\Seeder;
use App\ConfigMaterial;

class ConfigMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_names = ['App\SheetProduction', 'App\DirectProduction'];

        $data = [
            [1, 2, 4],
            [3, 5, 6]
        ];

        foreach($config_names as $key => $config_name){
            foreach($data[$key] as $d_key => $data_single){
                ConfigMaterial::create([
                    'company_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'name' => $config_name,
                    'raw_material_id' => $data_single
                ]);    
            }
        }
    }
}
