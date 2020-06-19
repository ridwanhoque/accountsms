<?php

use Illuminate\Database\Seeder;

class dummy_payment_methods__table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account_information = AccountInformation::where('company_id', 1)->get();
        foreach($account_information as $acc_info){
            $data = [
                [
                    'company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'account_information_id' => $acc_info->id,
                    'method_name' => $acc_info->name, 'status' => 1,
                ]
            ];    
        }

        dd($data);
    }
}
