<?php

use Illuminate\Database\Seeder;
use App\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['Natural-0', 'Natural-1', 'Natural-2', 'Natural-3', 'Natural-4', 'Natural-5', 
                    'White-0', 'White-1', 'White-2', 'White-3', 'White-4', 'White-5', 
                    'Red-0', 'Red-1', 'Red-2', 'Red-3', 'Red-4', 'Red-5', 
                    'Green-0', 'Green-1', 'Green-2', 'Green-3', 'Green-4', 'Green-5',
                    'Black-0', 'Black-1', 'Black-2', 'Black-3', 'Black-4', 'Black-5',
                    'Yellow-0', 'Yellow-1', 'Yellow-2', 'Yellow-3', 'Yellow-4', 'Yellow-5',
                    'Red/White'
                    ];
        
        foreach($colors as $color){
            Color::create([
                'company_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'name' => $color
            ]);    
        }
    }
}
