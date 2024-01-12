<?php

use App\Http\Controllers\AdmincatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardListController;
use App\Models\User;
use App\Models\Category;
use App\Models\Listmovie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class,'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/list', DashboardListController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdmincatController::class)->except('show')->middleware('admin');

Route::get('/dashboard/list/cekSlug', [DashboardListController::class,'cekSlug'])->middleware('auth');

Route::get('/export', [DashboardListController::class, 'export'])->name('export');
Route::post('/import', [DashboardListController::class, 'import'])->name('import');

// Route::get('/exportlistmov', [DashboardListController::class, 'listmovexport'])->middleware('auth')->name('exportlistmov');

// // Route::get('/importlistmov', [DashboardListController::class, 'index'])->name('importlistmov');
// Route::post('/importlistmov', [DashboardListController::class, 'listmovimport'])->middleware('auth')->name('importlistmov');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/exportlistmov', [DashboardListController::class, 'listmovexport']);
// });

// Route::get('/home', function () {
//     return view('home', [
//         "title" => "Home",
//         "active" => 'home'
//     ]);
// });

// Route::get('/about', function () {
//     return view('about', [
//         "title" => "About",
//         "active" => 'about',
//         "name" => "One Piece",
//         "email" => "wirya@gmail.com",
//         "image" => "mangwi.jpg"
//     ]);
// });


Route::get('/list', [ListController::class, 'index']);

Route::get('/list/{list:slug}', [ListController::class, 'show']);

Route::get('/categories', function(){
    return view('categories', [
        'title' => 'List Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('list', [
//         'title' =>"List by Category :  $category->name",
//         'active' => 'categories',
//         'list' => $category->list
//     ]);
// });

//  Route::get('/authors/{author:username}', function(User $author){
//     return view('list', [
//         'title' => "Write By Author : $author->name",
//         'active' => "list",
//         'list' => $author->list->load('category', 'author')
//     ]);
//  });

// Route::get('/connection', function () {
//         try{
//             DB::connection()->getPdo();
//             return 'conected sukses';
//         }
//         catch(\Exception $ex){
//             dd($ex->getMessage());
//         }
//     });

