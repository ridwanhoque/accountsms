<?php

use Illuminate\Database\Seeder;
use App\ChartOfAccount;
use App\Company;
use App\User;

class dummy_chart_of_accounts_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_id = Company::first()->id;
        $user_id = User::first()->id;

        $data = [
            ['company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'type' => 'expenses', 'head_name' => 'Raw Material Purchase', 'status' => 1],
            ['company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'type' => 'income', 'head_name' => 'Cost of Goods Sold', 'status' => 1],
            ['company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'type' => 'expenses', 'head_name' => 'Administrative Expenses', 'status' => 1],
            ['company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'type' => 'income', 'head_name' => 'Other Income', 'status' => 1],
            ['company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'type' => 'income', 'head_name' => 'Cost of Goods Sold', 'status' => 1],
            ['company_id' => $company_id, 'created_by' => $user_id, 'updated_by' => $user_id, 'type' => 'income', 'head_name' => 'Revenue from Sales', 'status' => 1]
        ];

        foreach($data as $chart){
            ChartOfAccount::create($chart);
        }

    }
}
