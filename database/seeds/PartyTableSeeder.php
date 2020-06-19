<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 2) as $party_type){
            DB::table('parties')->insert([
                'company_id' => '1',
                'created_by' => '1',
                'updated_by' => '1',
                'party_type' => $party_type,
                'name' => 'Smart Software '.$party_type,
                'email' => 'smartsoftware@gmail.com',
                'phone' => '01710777000',
                'address' => 'Panthpath, Dhanmondi-32, Dhaka',
                'status' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
        
    }
}
