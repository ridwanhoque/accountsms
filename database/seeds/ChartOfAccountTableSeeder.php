<?php

use Illuminate\Database\Seeder;
use App\ChartOfAccount;
use App\ChartType;

class ChartOfAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // totp-hol = pr

    //     $default_charts_____ = [
    //         // 'head_name','parent_id','tire','chart_type_id','owner_type_id','slug'
    //         ['Purchase', null, 1, 2, 4, 'purchase'],//1
    //         ['Purchase Return', null, 1, 1, 4, 'purchase-return'],//2
    //         ['Sales', null, 1, 1, 4, 'sales'],//3
    //         ['Sales Return', null, 1, 2, 4, 'sales-return'],//4
            
    //         ['Non Current Assets', null, 1, 3, 4, 'non-current-assets'],//5
    //             ['Property Plant and Equipment', 5, 2, 3, 4, 'property-plant-and-equipment'],//6
    //                 ['Machinery & Equipment', 6, 3, 3, 4, null], //7
    //                 ['Land & Land Decoration', 6, 3, 3, 4, null], //8
    //                 ['Other Equipment', 6, 3, 3, 4, null], //9
    //                 ['Office Equipment', 6, 3, 3, 4, null], //10
    //                 ['Electric Equipment', 6, 3, 3, 4, null], //11
    //                 ['Furniture & Fixtures', 6, 3, 3, 4, null], //12
    //                 ['Computer System', 6, 3, 3, 4, null], //13
    //                 ['Building (Shade & Decoration)', 6, 3, 3, 4, null], //14
    //                 ['Spare Parts & Tools', 6, 3, 3, 4, null], //15
    //                 ['Van & Cookeries', 6, 3, 3, 4, null], //16
    //                 ['Office Decoration', 6, 3, 3, 4, null], //17
    //                 ['Car & Vehicles', 6, 3, 3, 4, null], //18
    //             ['Preliminary and Pre-Operational Expenses', 5, 2, 3, 4, 'preliminary-and-pre-operational-expenses'],//19
    //         ['Current Assets', null, 1, 3, 4, 'current-assets'],//20
    //             ['Advance, Deposits and Pre-payments', 20, 2, 3, 4, 'advance-deposits-and-pre-payments'],//21
    //                 ['Advance for Factory & Office Rent', 21, 3, 3, 4, null],//22
    //                 ['Advance for Godown Rent', 21, 3, 3, 4, null], //23
    //                 ['Advance for RM, PP & Ingredients', 21, 3, 3, 4, null], //24
    //                 ['Advance for Others', 21, 3, 3, 4, null], //25
    //                 ['Advance to Stuff', 21, 3, 3, 4, null], //26
    //                 ['Advance for Various Project Works', 21, 3, 3, 4, null], //27
    //             ['Accounts Receivable and Other Receivables', 20, 2, 3, 4, 'accounts-receivable-and-other-receivable'],//28
    //                 ['Corporate', 28, 3, 3, 4, 'corporate'],//29
    //                 ['Retail', 28, 3, 3, 4, 'retail'],//30
    //             ['Inventories', 20, 2, 3, 4, 'inventories'],//31
    //             ['Advance Tax', 20, 2, 3, 4, 'advance-tax'],//32
    //             ['VAT Current A/C', 20, 2, 3, 4, 'vat-current-account'],//33
    //             ['cash and cash equivalent', 20, 2, 3, 4, null],//34
    //                 ['Cash in hand', 34, 3, 3, 3, 'cash-in-hand'],//35
    //                 ['cash at bank', 34, 3, 3, 2, 'cash-at-bank'],//36
    // // 	Liability and Equity
    //         ['Equity', null, 1, 4, 4, 'equity'],//37
    //             ['Capital Account', 37, 2, 4, 4, 'capital-account'],//38
    //                 ['Authorised Capital', 38, 3, 4, 4, 'authorised-capital'],//39
    //                 ['Issued,  subscribed  and  paid - up', 38, 3, 4, 4, 'issued-subscribed-and-paid-up'],//40
    //             ['Share Premium', 37, 2, 4, 4, 'share-premium'], //41
    //             ['Share Money Deposits', 37, 2, 4, 4, 'share-money-deposits'], //42

    //         ['Liabilities', null, 1, 4, 4, 'liabilities'],//43



            
    //             ['Long Term Liabilities', 43, 2, 4, 4, 'long-term-liabilities'], //44
    //             ['Short Term Loan', 43, 2, 4, 4, 'short-term-loan'], //45
    //             ['Current Liabilities', 43, 2, 4, 4, 'current-liabilities'],//46
    //                 ['Accounts and other Trade Payable', 46, 3, 4, 4, 'accounts-and-other-trade-payable'],//47
    //                     ['Trade Payable', 47, 4, 4, 4, 'trade-payable'],//48   
    //                     ['Other Payable', 47, 4, 4, 4, 'other-payable'],//49
    //                 ['Income Tax Payable/Provision', 46, 3, 4, 4, 'income-tax-payable-provision'],//50
    //                     ['Tax Deduction at Source (TDS)', 50, 4, 4, 4, null], //51
    //                 ['Accumulated Depreciations', 46, 3, 4, 4, 'accumulated-depreciations'], //52
            
    // //income
    //         ['Other Income', null, 1, 1, 4, 'other-inceome'], //53
    // //expense
    //         ['Direct Expenses', null, 1, 2, 4, 'direct-expenses'],//54
    //         ['Factory Overhead', null, 1, 2, 4, 'factory-overhead'],//55
    //         ['Depreciation', null, 1, 2, 4, 'depreciation'],//56
    //         ['Administrative  Expenses', null, 1, 2, 4, 'administrative-expenses'],//57
    //         ['Selling and Distribution  Expenses', null, 1, 2, 4, 'selling-and-distribution-expenses'],//58
    //         ['Financial Expenses', null, 1, 2, 4, 'financial-expenses'],//59


            
    //     ];

 // 'head_name','parent_id','tire','chart_type_id','owner_type_id','slug','account_code'

        $default_charts = [

                //income
                ['Sales', null, 1, 1, 4, 'sales', '10'], //1
                ['Purchase Return', null, 1, 1, 4, 'purchase-return', '11'], //2
                ['Other Income', null, 1, 1, 4, 'other-incomed', '12'], //3
                    
                //expense
                ['Purchase', null, 1, 2, 4, 'purchase', '20'],//4
                ['Saes Return', null, 1, 2, 4, 'sales-return', '21'],//5
                ['Direct Expenses', null, 1, 2, 4, 'direct-expenses', '22'],//6
                ['Factory Overhead', null, 1, 2, 4, 'factory-overhead', '23'],//7
                ['Depreciation', null, 1, 2, 4, 'depreciation', '24'],//8
                ['Administrative  Expenses', null, 1, 2, 4, 'administrative-expenses', '25'],//9
                ['Selling and Distribution  Expenses', null, 1, 2, 4, 'selling-and-distribution-expenses', '26'],//10
                ['Financial Expenses', null, 1, 2, 4, 'financial-expenses', '27'],//11

                //asset
                ['Non Current Assets', null, 1, 3, 4, 'non-current-assets', '30'],//12
                    ['Property Plant and Equipment', 12, 2, 3, 4, 'property-plant-and-equipment', '301'],//13
                        ['Machinery & Equipment', 13, 3, 3, 4, null, '301-1'], //14
                        ['Land & Land Decoration', 13, 3, 3, 4, null, '301-2'], //15
                        ['Other Equipment', 13, 3, 3, 4, null, '301-3'], //16
                        ['Office Equipment', 13, 3, 3, 4, null, '301-4'], //17
                        ['Electric Equipment', 13, 3, 3, 4, null, '301-5'], //18
                        ['Furniture & Fixtures', 13, 3, 3, 4, null, '301-6'], //19
                        ['Computer System', 13, 3, 3, 4, null, '301-7'], //20
                        ['Building (Shade & Decoration)', 13, 3, 3, 4, null, '301-8'], //21
                        ['Spare Parts & Tools', 13, 3, 3, 4, null, '301-9'], //22
                        ['Van & Cookeries', 13, 3, 3, 4, null, '301-10'], //23
                        ['Office Decoration', 13, 3, 3, 4, null, '301-11'], //24
                        ['Car & Vehicles', 13, 3, 3, 4, null, '301-12'], //25
                    ['Preliminary and Pre-Operational Expenses', 12, 2, 3, 4, 'preliminary-and-pre-operational-expenses', '302'],//26
                ['Current Assets', null, 1, 3, 4, 'current-assets', '31'],//27
                    ['Advance, Deposits and Pre-payments', 27, 2, 3, 4, 'advance-deposits-and-pre-payments', '311'],//28
                        ['Advance for Factory & Office Rent', 28, 3, 3, 4, null, '311-1'],//29
                        ['Advance for Godown Rent', 28, 3, 3, 4, null, '311-2'], //30
                        ['Advance for RM, PP & Ingredients', 28, 3, 3, 4, null, '311-3'], //31
                        ['Advance for Others', 28, 3, 3, 4, null, '311-4'], //32
                        ['Advance to Stuff', 28, 3, 3, 4, null, '311-5'], //33
                        ['Advance for Various Project Works', 28, 3, 3, 4, null, '311-6'], //34
                    ['Accounts Receivable and Other Receivables', 27, 2, 3, 4, 'accounts-receivable-and-other-receivable', '312'],//35
                        ['Corporate', 35, 3, 3, 4, 'corporate', '312-1'],//36
                        ['Retail', 35, 3, 3, 4, 'retail', '312-2'],//37
                    ['Inventories', 27, 2, 3, 4, 'inventories', '313'],//38
                    ['Advance Tax', 27, 2, 3, 4, 'advance-tax', '314'],//39
                    ['VAT Current A/C', 27, 2, 3, 4, 'vat-current-account', '315'],//40
                    ['cash and cash equivalent', 27, 2, 3, 4, null, '316'],//41
                        ['Cash in hand', 41, 3, 3, 3, 'cash-in-hand', '316-1'],//42
                        ['cash at bank', 41, 3, 3, 2, 'cash-at-bank', '316-2'],//43


                //liabilities
                ['Capital Account', null, 1, 4, 4, 'capital-account', '40'],//44
                    ['Authorised Capital', 44, 2, 4, 4, 'authorised-capital', '401'],//45
                ['Issued,  subscribed  and  paid - up', null, 1, 4, 4, 'issued-subscribed-and-paid-up', '41'],//46
                    ['Share Premium', 46, 2, 4, 4, 'share-premium' , '410'], //47
                    ['Share Money Deposits', 46, 2, 4, 4, 'share-money-deposits', '411'], //48
                    ['Long Term Liabilities', 46, 2, 4, 4, 'long-term-liabilities', '412'], //49
                    ['Short Term Loan', 46, 2, 4, 4, 'short-term-loan', '413'], //50
                ['Accounts and other Trade Payable', null, 1, 4, 4, 'accounts-and-other-trade-payable', '42'],//51
                    ['Trade Payable', 51, 2, 4, 4, 'trade-payable', '421'],//52
                    ['Other Payable', 51, 2, 4, 4, 'other-payable', '422'],//53
                ['Income Tax Payable/Provision', null, 1, 4, 4, 'income-tax-payable-provision', '43'],//54
                    ['Tax Deduction at Source (TDS)', 54, 2, 4, 4, null, '431'], //55
                ['Accumulated Depreciations', null, 1, 4, 4, 'accumulated-depreciations', '44'], //56
                // ['Current Liabilities', 43, 2, 4, 4, 'current-liabilities', '45'],//

                
                //sample data
                ['Cash in Hand (Factory)', 42, 4, 3, 3, null, '316-3'],//57
                ['AB Plastic Color', 52, 3, 4, 1, null, '421-1'],//58
                ['Kazi Food Industries Limited', 36, 4, 3, 1, null, '312-3'],//59
             
       ];
        
        foreach ($default_charts as $default_chart) {
            ChartOfAccount::create([
                'company_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'head_name' => $default_chart[0],
                'parent_id' => $default_chart[1],
                'tire' => $default_chart[2],
                'chart_type_id' => $default_chart[3],
                'owner_type_id' => $default_chart[4],
                'is_default' => 1,
                'status' => 1,
                'slug' => $default_chart[5],
                'account_code' => $default_chart[6]
            ]);
        }

    }
}




