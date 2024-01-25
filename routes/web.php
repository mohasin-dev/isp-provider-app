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
    return view('welcome');
});

// Route::get('admin/dashboard', 'HomeController@index')->name('admin.dashboard');
// Route::resource('admin/category', 'CategoryController@index')->name('admin.category');

Route::group(['middleware'=>['auth']], function () {
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::resource('category','CategoryController');
    Route::resource('unit','UnitController');
    Route::resource('suplier','SuplierController');
    Route::resource('product','ProductController');
    Route::post('product-list','InventoryController@productList')->name('productList');
    Route::resource('inventory','InventoryController');
    Route::resource('expense-category','ExpenseCategoryController');
    Route::resource('expense','ExpenseController');
    Route::post('quantityCheck','DamageController@quantityCheck')->name('quantityCheck');
    Route::resource('damage','DamageController');
    Route::resource('customer','CustomerController');
    Route::resource('payment-method','PaymentMethodController');
    Route::resource('feature','FeatureController');
    Route::resource('package','PackageController');
    Route::resource('setting','SettingController');
    Route::get('expense-report','ReportController@expenseReport')->name('expense.report');
    Route::post('expense-report-result','ReportController@expenseReportResult')->name('expense.report.result');

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
