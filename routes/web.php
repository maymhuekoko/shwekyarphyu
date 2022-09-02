<?php

use Illuminate\Support\Facades\Route;

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

Route::get('localization/{locale}','LocalizationController@index');

Route::get('/', 'Web\LoginController@index')->name('index');

Route::post('Authenticate', 'Web\LoginController@loginProcess')->name('loginProcess');

Route::get('LogoutProcess', 'Web\LoginController@logoutProcess')->name('logoutprocess');


Route::group(['middleware' => ['UserAuth']], function () {
    Route::post('shopname/edit', 'Web\AdminController@shopnameEdit')->name('shopnameEdit');

    Route::get('ChangePassword-UI', 'Web\LoginController@getChangePasswordPage')->name('change_password_ui');
    Route::put('UpdatePassword', 'Web\LoginController@updatePassword')->name('update_pw');

    //Dashboard List
    Route::get('Inventory-Dashboard', 'Web\InventoryController@getInventoryDashboard')->name('inven_dashboard');
    Route::get('Stock-Dashboard', 'Web\StockController@getStockPanel')->name('stock_dashboard');
    Route::get('Sale-Dashboard', 'Web\SaleController@getSalePanel')->name('sale_panel');
    Route::get('Order-Dashboard', 'Web\OrderController@getOrderPanel')->name('order_panel');
    Route::get('Admin-Dashboard','Web\AdminController@getAdminDashboard')->name('admin_dashboard');

    //Ajax List
    Route::post('AjaxGetItem', 'Web\InventoryController@AjaxGetItem')->name('AjaxGetItem');
    Route::post('AjaxGetCountingUnit', 'Web\InventoryController@AjaxGetCountingUnit')->name('AjaxGetCountingUnit');
    Route::post('getunitprice', 'Web\InventoryController@getunitprice')->name('getunitprice');
    Route::post('getCountingUnitsByItemId', 'Web\SaleController@getCountingUnitsByItemId');
    Route::post('getCountingUnitsByItemCode', 'Web\SaleController@getCountingUnitsByItemCode');
    Route::post('getCustomerInfo', 'Web\AdminController@getCustomerInfo');
    Route::post('ajaxConvertResult', 'Web\InventoryController@ajaxConvertResult');
    Route::post('storeCustomerOrder', 'Web\OrderController@storeCustomerOrder');
    Route::post('getTotalSaleReport', 'Web\AdminController@getTotalSaleReport');
    Route::post('getTotalIncome', 'Web\AdminController@getTotalIncome');
    Route::post('showSubCategory', 'Web\InventoryController@showSubCategory');
    Route::post('AjaxGetCustomerList','Web\AdminController@getSalesCustomerList')->name('AjaxGetCustomerList');
    Route::post('AjaxGetCustomerwID','Web\AdminController@getSalesCustomerWithID')->name('AjaxGetCustomerwID');
    Route::post('AjaxStoreCustomer','Web\AdminController@storeSalesCustomer')->name('AjaxStoreCustomer');
    Route::post('changeCustomerPassword', 'Web\AdminController@changeCustomerPassword');

    Route::post('saleCustomerDelete','SaleCustomerController@delete')->name('saleCustomerDelete');
    Route::get('list','Web\AdminController@show_sale_customer_credit_list')->name('list');

    //Route::get('Sale/shistory','Web\AdminController@history')->name('shistory');
    Route::get('credit/{id}','Web\AdminController@credit')->name('credit');
    Route::post('store_each_paid','Web\AdminController@store_eachPaid')->name('store_each_paid');
    Route::post('store_all_credit/{id}','Web\AdminController@store_allPaid')->name('store_all_credit');


    //Category

	Route::post('category/store', 'Web\InventoryController@storeCategory')->name('category_store');
	Route::post('category/update/{id}', 'Web\InventoryController@updateCategory')->name('category_update');
    Route::post('category/delete', 'Web\InventoryController@deleteCategory');
    Route::get('category', 'Web\InventoryController@categoryList')->name('category_list');

	//SubCategory
	Route::get('subcategory', 'Web\InventoryController@subcategoryList')->name('subcategory_list');
	Route::post('subcategory/store', 'Web\InventoryController@storeSubCategory')->name('sub_category_ store');
	Route::post('subcategory/update/{id}', 'Web\InventoryController@updateSubCategory')->name('sub_category_update');


    //Item
	Route::get('item', 'Web\InventoryController@itemList')->name('item_list');
	Route::post('item/store', 'Web\InventoryController@storeItem')->name('item_store');
	Route::post('item/update/{id}', 'Web\InventoryController@updateItem')->name('item_update');
	Route::post('item/delete', 'Web\InventoryController@deleteItem');

    //Counting Unit
	Route::get('Count-Unit/{item_id}', 'Web\InventoryController@getUnitList')->name('count_unit_list');
    Route::post('Count-Unit/store', 'Web\InventoryController@storeUnit')->name('count_unit_store');
    Route::post('Count-Unit/update/{id}', 'Web\InventoryController@updateUnit')->name('count_unit_update');
    Route::post('Count-Unit/code_update/{id}', 'Web\InventoryController@updateUnitCode')->name('count_unit_code_update');
    Route::post('Count-Unit/original_code_update/{id}', 'Web\InventoryController@updateOriginalCode')->name('original_code_update');
    Route::post('Count-Unit/delete', 'Web\InventoryController@deleteUnit');

    //Counting Unit Relation
    Route::get('Unit-Relation/{item_id}', 'Web\InventoryController@unitRelationList')->name('unit_relation_list');
    Route::post('Unit-Relation/store', 'Web\InventoryController@storeUnitRelation')->name('unit_relation_store');
    Route::post('Unit-Relation/update/{id}', 'Web\InventoryController@updateUnitRelation')->name('unit_relation_update');

    //Counting Unit Conversion
    Route::get('Unit-Convert/{unit_id}', 'Web\InventoryController@convertUnit')->name('convert_unit');
    //Route::post('Unit-Convert/store', 'Web\InventoryController@convertCountUnit')->name('convert_count_unit');

    //item adjust
    Route::get('item-adjust', 'Web\StockController@itemadjust')->name('itemadjust');

    //StockCount
    Route::get('Stock-Count/Count', 'Web\StockController@getStockCountPage')->name('stock_count');
    Route::get('stocklists', 'Web\StockController@getstocklists')->name('stock_lists');
    Route::get('Stock-Count/Price', 'Web\StockController@getStockPricePage')->name('stock_price_page');
    Route::get('Stock-Count/Reorder', 'Web\StockController@getStockReorderPage')->name('stock_reorder_page');
    Route::post('Stock-Count/UpdateCount', 'Web\StockController@updateStockCount')->name('update_stock_count');
    Route::post('Stock-Count/UpdatePrice', 'Web\StockController@updateStockPrice')->name('update_stock_price');

    //Employee
    Route::get('Employee', 'Web\AdminController@getEmployeeList')->name('employee_list');
    Route::post('Employee/store', 'Web\AdminController@storeEmployee')->name('employee_store');
    Route::get('Employee/details/{id}', 'Web\AdminController@getEmployeeDetails')->name('employee_details');
    Route::post('employee-update', 'Web\AdminController@employeeupdate')->name('employee.update');

    //Customer
    Route::get('Customer', 'Web\AdminController@getCustomerList')->name('customer_list');
    Route::post('Customer/store', 'Web\AdminController@storeCustomer')->name('store_customer');
    Route::get('Customer/details/{id}', 'Web\AdminController@getCustomerDetails')->name('customer_details');
    Route::post('Customer/update/{id}', 'Web\AdminController@updateCustomer')->name('customer_update');
    Route::post('Customer/Change-Level', 'Web\AdminController@changeCustomerLevel')->name('change_customer_level');

    //Sale
    Route::get('Sale', 'Web\SaleController@getSalePage')->name('sale_page');
    Route::post('Sale/Voucher', 'Web\SaleController@storeVoucher');
    Route::post('Sale/Get-Voucher', 'Web\SaleController@getVucherPage')->name('get_voucher');
    Route::get('Sale/History', 'Web\SaleController@getSaleHistoryPage')->name('sale_history');
    Route::get('Sale/SummaryMain','Web\SaleController@getVoucherSummaryMain')->name('voucher_summary_main');
    Route::post('Sale/SummaryDetail','Web\SaleController@searchItemSalesByDate')->name('search_item_sales_by_date');
    Route::post('Sale/Search-History', 'Web\SaleController@searchSaleHistory')->name('search_sale_history');
    Route::post('serarch-item-adjusts', 'Web\SaleController@searchItemAdjusts')->name('search_item_adjusts');
    Route::post('voucher-delete', 'Web\SaleController@voucherDelete')->name('voucher_delete');
    Route::get('serarch-item-adjusts', function () {
        return redirect()->route('itemadjust-lists');
    });
    Route::post('Sale/search_sale_discount_record', 'Web\SaleController@search_sale_discount_record')->name('search_sale_discount_record');
    Route::get('Sale/Voucher-Details/{id}', 'Web\SaleController@getVoucherDetails')->name('getVoucherDetails');
    Route::get('discount_record_list','Web\SaleController@show_discount_list')->name('discount_record_list');
    Route::post('getSelectionDiscount','Web\SaleController@show_discount_type')->name('getSelectionDiscount');
    Route::post('getDateDiscount','Web\SaleController@show_discount_date')->name('getDateDiscount');
    Route::post('get_discount_main_type','Web\SaleController@ajax_get_discount_main')->name('get_discount_main_type');
    Route::post('get_foc','Web\SaleController@ajax_get_foc')->name('get_foc');
    Route::post('get_item','Web\SaleController@ajax_get_item')->name('get_item');
    Route::post('get_vou','Web\SaleController@ajax_get_vou')->name('get_vou');
    Route::post('get_date','Web\SaleController@ajax_get_date')->name('get_date');
    //Order
    Route::get('Order/{type}', 'Web\OrderController@getOrderPage')->name('order_page');
    Route::get('Order-Details/{id}', 'Web\OrderController@getOrderDetailsPage')->name('order_details');
    Route::post('Order/Change', 'Web\OrderController@changeOrderStatus')->name('update_order_status');
    Route::get('Order/Voucher/History', 'Web\OrderController@getOrderHistoryPage')->name('order_history');
    Route::post('Order/Voucher/Search-History', 'Web\OrderController@searchOrderVoucherHistory')->name('search_order_history');
    Route::get('Sale/Search-History', 'Web\SaleController@searchSaleHistoryget');
    Route::get('Order/Voucher-Details/{id}', 'Web\OrderController@getVoucherDetails')->name('voucher_order_details');

    Route::post('mobile-print','Web\AdminController@mobileprint');
    //Purchase
    Route::get('Purchase', 'Web\AdminController@getPurchaseHistory')->name('purchase_list');
    Route::get('Purchase/Details/{id}', 'Web\AdminController@getPurchaseHistoryDetails')->name('purchase_details');
    Route::get('Purchase/Create', 'Web\AdminController@createPurchaseHistory')->name('create_purchase');
    Route::post('Purchase/Store', 'Web\AdminController@storePurchaseHistory')->name('store_purchase');
    Route::post('store_supplier', 'Web\AdminController@store_supplier')->name('store_supplier');
    Route::get('add_supplier', 'Web\AdminController@add_supplier')->name('add_supplier');
    Route::get('suppliercreditlist','Web\AdminController@show_supplier_credit_lists')->name('supplier_credit_list');
    Route::get('supcredit/{id}','Web\AdminController@supplier_credit')->name('supcredit');
    Route::post('store_each_paid_supplier','Web\AdminController@store_eachPaidSupplier')->name('store_each_paid_supplier');
    Route::post('store_all_suppliercredit/{id}','Web\AdminController@store_allSupplierPaid')->name('store_all_suppliercredit');
    Route::post('getPurchaseData','Web\AdminController@getPurchase_Info')->name('getPurchaseData');
    Route::post('getsell_end','Web\AdminController@getsell_end_info')->name('getsell_end');


    //financial
    Route::get('fixasset', 'Web\AdminController@showFixasset')->name('fixasset');
    Route::get('show_capital', 'Web\AdminController@show_capitalPanel')->name('show_capital');

    Route::post('store_capital', 'Web\AdminController@store_capitalInfo')->name('store_capital');
    Route::get('addasset', 'Web\AdminController@addasset')->name('addasset');
    Route::get('Financial', 'Web\AdminController@getTotalSalenAndProfit')->name('financial');
    Route::get('Expenses', 'Web\AdminController@expenseList')->name('expenses');
    Route::get('Incomes', 'Web\AdminController@incomeList')->name('incomes');
    Route::post('storeExpense', 'Web\AdminController@storeExpense')->name('store_expense');
    Route::post('storeIncome', 'Web\AdminController@storeIncome')->name('store_income');
    Route::post('store_asset', 'Web\AdminController@storeAsset')->name('store_asset');
    Route::post('store_sell_end', 'Web\AdminController@storeSellEnd')->name('store_sell_end');
    Route::post('store_reinvest','Web\AdminController@store_reinvest_info')->name('store_reinvest');
    Route::post('store_withdraw','Web\AdminController@store_withdraw_info')->name('store_withdraw');



    //delete for sale customer from vouncher blade
    route::get('delete_saleuser/{id}','Web\SaleController@delete_saleuser')->name('delete_saleuser');

    Route::get('new-asset', 'Web\AdminController@getnewAsset')->name('get_new_asset');


    Route::get('wayPlanning', 'Web\DeliveryController@wayPlaningForm')->name('way_planing_form');

    Route::get('wayPlanningLists', 'Web\DeliveryController@wayPlaningLists')->name('way_planing_lists');

    Route::post('wayplanning/store', 'Web\DeliveryController@wayplanningstore')->name('wayplanning.store');

    Route::post('deliveryorder/receive/store', 'Web\DeliveryController@deliveryOrderReceiveStore')->name('deliveryorderreceive.store');



    Route::get('shop-lists', 'Web\DeliveryController@getshopList');

    Route::get('Admin/Shop/{id}', 'Web\DeliveryController@SalePage')->name('admin_sale_page');
    Route::post('testVoucher', 'Web\DeliveryController@storetestVoucher');
    Route::post('getItemForA5', 'Web\DeliveryController@getItemA5')->name('getItemForA5');


	Route::get('item-assign', 'Web\InventoryController@itemAssign')->name('item_assign');
	Route::post('assign-item-ajax', 'Web\InventoryController@itemAssignajax')->name('item_assign_ajax');
	Route::post('assign-itemshop', 'Web\InventoryController@itemAssignShop');

	Route::post('stockupdate-ajax', 'Web\StockController@stockUpdateAjax')->name('stockupdate-ajax');
	Route::post('purchseupdate-ajax', 'Web\StockController@purchaseUpdateAjax')->name('purchaseupdate-ajax');
	Route::post('itemadjust-ajax', 'Web\StockController@itemadjustAjax')->name('itemadjust-ajax');
	Route::get('itemadjust-lists', 'Web\StockController@itemadjustLists')->name('itemadjust-lists');

	Route::get('fixedasset-lists', 'Web\AdminController@getFixedAssets')->name('fixedasset-lists');

    Route::get('itemrequestlists', 'Web\AdminController@itemrequestlists')->name('itemrequestlists');
    Route::post('store_itemrequest', 'Web\AdminController@store_itemrequest')->name('store_itemrequest');

    Route::get('itemrequest/details/{id}', 'Web\AdminController@getRequestHistoryDetails')->name('request_details');
    Route::get('create/itemrequest', 'Web\AdminController@create_itemrequest')->name('create_itemrequest');
    Route::post('requestitems/send', 'Web\AdminController@requestitemssend')->name('requestitemssend');
    Route::post('purchaseprice/update', 'Web\AdminController@purchasepriceUpdate')->name('purchasepriceupdate');
    Route::post('delete_units', 'Web\AdminController@delete_units')->name('delete_units');


    Route::post('purchase_delete', 'Web\AdminController@purchaseDelete')->name('purchase_delete');


});

Route::get('/excel', function () {
    return view('Admin.execel');
});
Route::post('execelImport', 'Web\AdminController@execelImport')->name('execelImport');
