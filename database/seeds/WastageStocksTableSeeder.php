<?php

use Illuminate\Database\Seeder;
use App\WastageStock;

class WastageStocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wastage_types = config('app.wastage_types');

        foreach($wastage_types as $type){
            WastageStock::create([
                'company_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'type' => $type
            ]);    
        }
    }
}
