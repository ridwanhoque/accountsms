<?php

use Illuminate\Database\Seeder;
use App\Batch;
class BatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Batch::create([
            'company_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'name' => 'Batch-1'
        ]);
    }
}
