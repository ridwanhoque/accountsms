<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group(['middleware' => ['auth', 'api']], function()
// {
//     Route::get('sale/invoice_quantity', 'SaleController@ajax_invoice_quantity');
// }
// );

Route::middleware('api')->group(function () {
    Route::get('sale/invoice_quantity', 'SaleController@ajax_invoice_quantity');
    Route::get('sheetproductiondetailsstock/sheet_kg_roll', 'SheetproductiondetailsStockController@ajax_sheet_kg_roll');
    Route::get('product_stocks/get_product_stock', 'ProductStockController@ajax_get_product_stock');
    Route::get('product_stocks/get_product_branch_stock', 'ProductStockController@ajax_get_product_branch_stock');
    Route::get('payment_methods/get_payment_method', 'PaymentMethodController@ajax_get_payment_method');
    Route::post('opening_sheet_save/qty_kgs', 'OpeningSheetController@ajax_qty_save');
    Route::get('chart_of_accounts/get_charts', 'ChartOfAccountController@ajax_get_charts');
    Route::get('chart_of_accounts/get_chart_data', 'ChartOfAccountController@ajax_get_chart_of_account_balance');
});