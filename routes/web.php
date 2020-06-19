<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('companies', 'CompanyController');

    Route::get('users/edit', 'UserController@edit');
    Route::post('users/update', 'UserController@update');
    Route::get('users/change_password', 'UserController@change_password_form');
    Route::post('users/change_password', 'UserController@change_password');
    Route::get('users/list', 'UserController@user_list');

    Route::get('users/add-new', 'UserController@add_new_user_form');
    Route::post('users/add-new', 'UserController@add_new_user');
    Route::get('users/edit-user/{id}', 'UserController@edit_user_form');
    Route::post('users/update-user', 'UserController@edit_user');
    Route::get('users/show/{id}', 'UserController@show_user');
    Route::post('users/user-delete', 'UserController@delete_user');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('customers', 'CustomerController');
    Route::resource('issue_materials', 'IssueMaterialController');
    
    Route::resource('temporary_sheet_productions', 'TemporarySheetProductionController');

    Route::get('sheet_productions/load_kutchas', 'SheetProductionController@ajax_load_kutchas');
    Route::get('sheet_productions/material_check', 'SheetProductionController@ajax_material_check');
    Route::get('sheet_productions/fm_kutcha_check', 'SheetProductionController@ajax_fm_kutcha_check');
    Route::get('sheet_productions/load_sheet_sizes', 'SheetProductionController@ajax_sheet_sizes');
    Route::resource('sheet_productions', 'SheetProductionController');
    
    Route::resource('temporary_direct_productions', 'TemporaryDirectProductionController');

    Route::get('direct_productions/kutcha_by_product', 'DirectProductionController@ajax_load_kutcha_by_product_id');
    Route::resource('direct_productions', 'DirectProductionController');

    Route::group(['prefix' => 'production_settings'], function () {
        Route::resource('batches', 'BatchController');
        Route::resource('colors', 'ColorController');
        Route::resource('raw_materials', 'RawMaterialController');
        Route::resource('sub_raw_materials', 'SubRawMaterialController');
        Route::get('products/get_products', 'ProductController@ajax_products');
        Route::resource('products', 'ProductController');
        Route::resource('machines', 'MachineController');
        Route::resource('sheet_sizes', 'SheetSizeController');
        Route::resource('fm_kutchas', 'FmKutchaController');
        Route::resource('branches', 'BranchController');

        Route::get('opening_sub_raw_materials', 'OpeningSubRawMaterialController@index');
        Route::post('opening_sub_raw_material_store', 'OpeningSubRawMaterialController@store');
        Route::get('opening_fm_kutchas', 'OpeningFmKutchaController@index');
        Route::post('opening_fm_kutcha_store', 'OpeningFmKutchaController@store');
		Route::get('opening_products', 'OpeningProductController@index');
        Route::post('opening_product_store', 'OpeningProductController@store');
		Route::get('opening_sheets', 'OpeningSheetController@index');
        Route::post('opening_sheet_store', 'OpeningSheetController@store');
		Route::get('opening_haddi_powders', 'OpeningHaddiPowderController@index');
        Route::post('opening_haddi_powder_store', 'OpeningHaddiPowderController@store');
    });

    Route::resource('wastages', 'WastageController');
    Route::get('purchasedetails', 'PurchaseReceiveController@details_ajax');
    Route::resource('purchases', 'PurchaseController');
    Route::resource('purchase_receives', 'PurchaseReceiveController');
    Route::resource('sale_quotations', 'SaleQuotationController');
    Route::resource('sales', 'SaleController');
    Route::get('product_deliveries/invoice_by_product', 'ProductDeliveryController@ajax_invoice_by_product');
    Route::get('product_deliveries/sale_invoice_qty', 'ProductDeliveryController@ajax_sale_invoice_qty');
    Route::resource('product_deliveries', 'ProductDeliveryController');

    Route::resource('temporary_daily_productions', 'TemporaryDailyProductionController');
    Route::get('daily_productions/get_sheet_stock_data', 'DailyProductionController@ajax_get_sheet_stock');
    Route::get('daily_productions/get_product_data', 'DailyProductionController@get_product_data');
    Route::resource('daily_productions', 'DailyProductionController');
    Route::resource('store_officers', 'StoreOfficerController');

    Route::resource('product_stock_transfers', 'ProductStockTransferController');

//    Accounting and finance
    Route::resource('chart_of_accounts', 'ChartOfAccountController');
    Route::resource('chart-of-account', 'ChartOfAccountController');
    Route::resource('account-information', 'AccountInformationController');
    Route::resource('payment-method', 'PaymentMethodController');
    Route::resource('party', 'PartyController');
    Route::resource('vendor', 'VendorController');
    Route::resource('voucher', 'VoucherController');
    Route::resource('pettycash_charts', 'PettycashChartController');
    Route::get('get-payment-method', 'VoucherController@get_payment_method')->name('voucher.get-payment-method');

    // Route::put('asset_chart_update/{id}', 'AssetChartController@updateChart');
    Route::resource('asset_charts', 'AssetChartController');
    Route::get('opening_assets', 'OpeningAssetController@index');
    Route::post('opening_asset_store', 'OpeningAssetController@store');

    // Role permissions
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('user_roles', 'UserRoleController');

    Route::group(['prefix' => 'accounting'], function () {
        Route::get('fund_transfers/account_balance', 'FundTransferController@get_account_balance');
        Route::resource('fund_transfers', 'FundTransferController');
        Route::resource('pettycash_deposits', 'PettycashDepositController');
        Route::resource('pettycash_expenses', 'PettycashExpenseController');
        Route::resource('advance_payments', 'AdvancePaymentController');
        Route::get('voucher_payments/{id}', 'DuePaymentController@voucher_payments');
        Route::get('payment_invoice/{id}', 'DuePaymentController@payment_invoice');
        Route::resource('due_payments', 'DuePaymentController');
        Route::resource('assets', 'AssetController');
        Route::resource('ledgers', 'LedgerController');

        //accounts
        Route::resource('payment_vouchers', 'Accounts\PaymentVoucherController');
        Route::resource('receive_vouchers', 'Accounts\ReceiveVoucherController');
        Route::resource('journal_vouchers', 'Accounts\JournalVoucherController');
		Route::resource('contra_vouchers', 'Accounts\ContraVoucherController');
        Route::resource('journals', 'Accounts\JournalController');

    });

    Route::group(['prefix' => 'reports'], function () {

        //production report
        Route::get('opening_raw_material_stocks', 'OpeningRawMaterialStockController@report');
        
        Route::get('raw_material_stocks', 'RawMaterialStockController@report');
        Route::get('raw_material_stocks/filter', 'RawMaterialStockController@filter');

        Route::get('raw_material_batch_stocks', 'RawMaterialStockBatchController@report');
        Route::get('rm_batch_stocks', 'RmBatchStockController@report');

        Route::get('sheet_stocks', 'SheetStockController@report');
        Route::get('sheet_stocks/filter', 'SheetStockController@filter');
        Route::get('sheet_material_stocks', 'SheetproductiondetailsStockController@report');

        Route::get('wastage_stocks', 'WastageStockController@report');

        Route::get('product_stocks', 'ProductStockController@report');
        Route::get('product_branch_stocks', 'ProductBranchStockController@report');
        Route::get('product_summary_report', 'ProductSummaryReportController@report');

        Route::get('kutcha_summary_report', 'KutchaSummaryReportController@report');
        Route::get('kutcha_inout_stocks', 'KutchaInoutReportController@index');
        Route::get('kutcha_wastage_stocks', 'KutchaWastageStockController@report');
        Route::get('daily_kutcha_stocks', 'DailyKutchaReportController@report');
        Route::get('forming_wastage_stocks', 'FormingWastageStockController@report');

        Route::get('haddi_powder_stocks', 'HaddiPowderStockController@index');

        Route::get('sheet_stocks', 'SheetStockController@report');
        Route::get('sheet_stocks/filter', 'SheetStockController@filter');

        //Accounting Report
        Route::get('income-expense', 'ReportController@reportPage');
        Route::get('income-expense/filter', 'ReportController@searchReport');
        Route::get('accounts_dashboard', 'AccountsDashboardController@report');
        Route::get('accounts_receivable', 'AccountsReceivableController@report');
        Route::get('accounts_payable', 'AccountsPayableController@report');
        Route::get('income_statement', 'IncomeStatementController@report');
        Route::get('cash_flow', 'CashFlowController@report');
        Route::get('payable_dues', 'PurchaseDueController@report');


        //Accounts Report
        Route::get('balance_sheet', 'Accounts\BalanceSheetController@report');
        Route::get('income_expense', 'Accounts\IncomeExpenseController@report');
        Route::get('receivable_accounts', 'Accounts\ReceivableAccountsController@report');
        Route::get('payable_accounts', 'Accounts\PayableAccountsController@report');
        Route::get('ledger_balance', 'Accounts\LedgerBalanceReportController@report');
        Route::get('trial_balance', 'Accounts\TrialBalanceController@report');
        Route::get('trial_balance/{id}', 'Accounts\TrialBalanceController@details');
    });


    Route::get('test', 'SheetProductionController@test');



});
