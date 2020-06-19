<?php

use Illuminate\Database\Seeder;
use App\SheetSize;
use App\RawMaterial;

class SheetSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SheetSize::create([
            'company_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'name' => '37*640',
            'raw_material_id' => RawMaterial::first()->id
        ]);
    }
}
