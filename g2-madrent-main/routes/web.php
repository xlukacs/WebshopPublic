<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnketaController;

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

Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('/products', [Controller::class, 'products'])->name('products');
Route::get('/category/{categoryName}/products{args?}', [Controller::class, 'productsWithCategory']);
Route::get('/category/{categoryName}', [Controller::class, 'category']);

Route::get('/adminPanel', [AdminController::class, 'showPanel']);
Route::get('/adminPanel/addRecord/{tableName}', [AdminController::class, 'addRecord'])->name('addRecord');
Route::delete('/adminPanel/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
Route::delete('/adminPanel/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
Route::delete('/adminPanel/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
Route::patch('/adminPanel/updateCategory/{id}', [AdminController::class, 'updateCategory'])->name('updateCategory');
Route::patch('/adminPanel/updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('updateProduct');
Route::patch('/adminPanel/updateUser/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
Route::patch('/adminPanel/editRecords/{tableName}/{id}', [AdminController::class, 'updateRecord'])->name('updateRecord');
Route::put('/adminPanel/insertCategoryGroup', [AdminController::class, 'insertCategoryGroup'])->name('insertCategoryGroup');
Route::put('/adminPanel/insertProduct', [AdminController::class, 'insertProduct'])->name('insertProduct');
Route::put('/adminPanel/insertUser', [AdminController::class, 'insertUser'])->name('insertUser');
Route::get('/adminPanel/showSearchResult', [AdminController::class, 'showSearchRes'])->name('showSearchRes');

Route::get('/setlang/{lang}', [LanguageController::class, 'setlang'])->name('setlang');

Route::get('/cart/addToCart/{itemID}', [CartController::class, 'addToCart'])->name('addtocart');
Route::get('/cart/removeFromCart/{itemID}', [CartController::class, 'removeFromCart'])->name('removefromcart');
Route::get('/cart/deleteFromCart/{itemID}', [CartController::class, 'deleteFromCart'])->name('deletefromcart');
Route::get('/cart/clearCart', [CartController::class, 'clearCart']);
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/checkout', [CartController::class, 'saveOrder'])->name('saveOrder');

//Route::post('/products', [Controller::class, 'searchResults'])->name('searchResults');

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('settings');
Route::patch('/profile/applySettings/{colName}', [ProfileController::class, 'applySettings'])->name('applySettings');

Route::get('/product/{productID}/', [Controller::class, 'product'])->name('product');
Route::get('/product/{productID}/reviews', [Controller::class, 'product_reviews']);//->name('product_reviews')

Route::get('/profile/edit_data/{id}', [ProfileController::class, 'edit']);
Route::post('/profile/edit_data/{id}', [ProfileController::class, 'update']);

Route::put('/submitVote', [AnketaController::class, 'submit']);
Route::get('/anketaManager', [AnketaController::class, 'view'])->name('anketaManager');
Route::get('/addQuestion', [AnketaController::class, 'add']);
Route::put('/insertQuestion', [AnketaController::class, 'insert']);
Route::get('/patchQuestion', [AnketaController::class, 'viewEdit']);
Route::delete('/deleteQuestion', [AnketaController::class, 'remove']);
Route::get('/showQuestionResult', [AnketaController::class, 'show']);

Route::get('/saveAnswer', [AnketaController::class, 'saveAnswer']);
Route::get('/addAnswer', [AnketaController::class, 'addAnswerPage']);
Route::get('/addAnswerToPool', [AnketaController::class, 'insertAnswer']);

Auth::routes();

require __DIR__.'/auth.php';
