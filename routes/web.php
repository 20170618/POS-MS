<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LiveSearch;

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

// Route::get('/', [HomeController::class, 'firstrun']);
//  Route::get('/', function () {
//      return view('auth.firstSetup');
//  });
//  Route::get('/', [HomeController::class, 'firstrun'])->name('setup');

Route::get('/test',[HomeController::class, 'createPDF']);


 if (User::exists()) {
     Route::get('/', function () {
        return view('auth.login');
    });
 } else {
     Route::get('/', function () {
        return view('firstSetup');
    });
}

//    Route::get('/login', function () {
//    return view('firstSetup');
//     });
// }

// Route::get('/firstSetup', function () {
//     return view('firstSetup');
//      });

Route::get('/reportPreview', function () {
    return view('reportPreview');
     });

     Route::get('/exportToPDF', function () {
        return view('exportToPDF');
         });



Auth::routes(['verify' => true]);

Route::group(['prefix'=>'admin', 'middleware'=>['roleCheck','auth']], function(){
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('profile', [HomeController::class, 'adminProfile'])->name('admin.profile');
    Route::put('profile/update-user/{id}', [UserController::class, 'update']);

    Route::get('categories', [HomeController::class, 'categoriesView'])->name('admin.categories');
    Route::post('store-category', [HomeController::class, 'categoryStore']);
    Route::get('categories/edit-category/{id}', [HomeController::class, 'categoryEdit']);
    Route::get('categories/delete-category/{id}', [HomeController::class, 'categoryEdit']);
    Route::put('categories/update-category/{id}', [HomeController::class, 'categoryUpdate']);
    Route::delete('categories/delete-product/{id}', [HomeController::class, 'categoryDestroy']);

    Route::get('products', [HomeController::class, 'adminProducts'])->name('admin.products');
    Route::post('products', [ProductController::class, 'store']);
    Route::get('products/view-products/{id}', [ProductController::class, 'view']);
    Route::get('products/edit-product/{id}', [ProductController::class, 'edit']);
    Route::put('products/update-product/{id}', [ProductController::class, 'update']);
    Route::get('products/delete-product/{id}', [ProductController::class, 'edit']);
    Route::delete('products/delete-product/{id}', [ProductController::class, 'destroy']);
    Route::get('/products_search/action', [LiveSearch::class, 'action'])->name('products_search.action');

    Route::get('searchProductUnderCat', [HomeController::class, 'searchUnderCategory']);

    Route::get('transactions', [HomeController::class, 'adminTransactions'])->name('admin.transactions');
    Route::get('transactionsSearch', [HomeController::class, 'searchTransactions'])->name('admin.transactionsSearch');
    Route::get('transactions/add', [HomeController::class, 'adminAddTransactions'])->name('admin.addtransaction');
    Route::post('transactions/store', [HomeController::class, 'storeTransaction'])->name('admin.storeTransaction');
    Route::post('transactions/store-debt', [HomeController::class, 'storeDebt']);
    Route::get('search', [HomeController::class, 'action'])->name('admin.search');
    Route::get('categoryinput/{query}', [HomeController::class, 'categoryInput'])->name('admin.categoryinput');
    Route::get('transactionDetails/{id}', [HomeController::class, 'transactionDetails'])->name('admin.transactionDetails');
    Route::get('transactions/edit/{id}', [HomeController::class, 'editTransaction'])->name('admin.editTransaction');
    Route::put('transactions/update/{id}', [HomeController::class, 'updateTransaction'])->name('admin.updateTransaction');

    Route::get('eload', [HomeController::class, 'adminEload'])->name('admin.eload');

    Route::get('searchUnderCategory', [HomeController::class, 'action']);

    Route::get('deleteTransaction/{id}', [HomeController::class, 'deleteTransaction']);
    Route::delete('destroyTransaction/{id}', [HomeController::class, 'destroyTransaction'])->name('admin.destroyTransaction');

    Route::get('debtors', [HomeController::class, 'adminDebtors'])->name('admin.debtors');
    Route::get('debtors-record/{id}',[HomeController::class, 'debtorsRecordView']);

    Route::get('userManagement', [HomeController::class, 'adminUserManagement'])->name('admin.userManagement');
    Route::get('userManagement/archive-user/{id}', [UserController::class, 'archive']);
    Route::put('userManagement/archive-user/{id}', [UserController::class, 'archiveUser']);

    Route::get('reports', [HomeController::class, 'adminReports'])->name('admin.reports');
    Route::get('reports/generate',[HomeController::class, 'adminGenerateReport']);
    // Route::get('/admin/PDF',[HomeController::class,'createPDF']);

    Route::get('admin/transactions/add', function () {
        return view('admin.addtransaction');
    });
});

Route::group(['middleware'=>['roleCheckUser','auth']], function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', function () {
        return view('salesperson.profile');
    });
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::get('addTransaction', [HomeController::class, 'salespersonAddTransactions'])->name('salesperson.salespersonaddtransaction');
    Route::get('search', [HomeController::class, 'action'])->name('salesperson.search');
    Route::post('addTransaction/store', [HomeController::class, 'storeTransaction'])->name('salesperson.storeTransaction');

    Route::get('viewtransactions', function () {
        return view('salesperson.viewtransaction');
    });

    Route::get('salespersonproducts', [HomeController::class, 'salespersonProducts'])->name('salesperson.salespersonproducts');
    Route::get('/product_search/action', [LiveSearch::class, 'action'])->name('product_search.action');
    Route::get('salesPersonEload', [HomeController::class, 'salesPersonEload'])->name('salesperson.eload');
    Route::get('searchProductUnderCat', [HomeController::class, 'searchUnderCategory']);
    Route::get('products/view-products/{id}', [ProductController::class, 'view']);

});

//  Route::post('transactions/store', [HomeController::class, 'storeTransaction'])->name('admin.storeTransaction');
