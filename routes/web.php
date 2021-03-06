<?php

use App\Http\Controllers\Admin\ParcerController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Cabinet\FavouriteRecipesController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\ListController;
use App\Http\Controllers\Cabinet\UserRecipeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientContorller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/popular', [RecipeController::class, 'popular'])->name('popular');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::group(['prefix' => 'news'], function () {
    Route::get('/', [NewsController::class, 'index'])->name('news');
    Route::get('/{categoryid}', [NewsController::class, 'index'])->where('categoryid', '\d+')->name('news.category');
    Route::get('/show/{news}', [NewsController::class, 'show'])->where('news', '\d+')->name('news.show');
});


Route::group(['prefix' => 'ingredient'], function () {
    Route::get('/', [IngredientContorller::class, 'index'])
        ->name('ingredients');

    Route::get('/{category_id}', [IngredientContorller::class, 'category'])
        ->where('category_id', '\d+')
        ->name('ingredient.category');

    Route::get('/show/{id}', [IngredientContorller::class, 'show'])
        ->where('ingredient', '\d+')
        ->name('ingredient.show');
});


Route::get('find', [SearchController::class, 'find'])->name('find');
Route::get('findByIngredients', [SearchController::class, 'findByIngredients'])->name('findByIngredients');
Route::get('findByRecipeName', [SearchController::class, 'findByRecipeName'])->name('findByRecipeName');
Route::get('findByRecipeCategory', [SearchController::class, 'findByRecipeCategory'])->name('findByRecipeCategory');
Route::get('findByRecipeOptions', [SearchController::class, 'findByRecipeOptions'])->name('findByRecipeOptions');

require __DIR__ . '/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::group(['prefix' => 'recipe'], function () {
    Route::get('/show/{id}', [RecipeController::class, 'show'])->where('id', '\d+')->name('recipe.show');
    Route::post('/like/{id}', [RecipeController::class, 'like'])->where('id', '\d+')->name('recipe.like')->middleware('auth');
});
Route::group(['prefix' => 'cabinet',  'as' => 'cabinet.', 'middleware' => 'auth'], function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('index');
    Route::get('profile-change', [ProfileController::class, 'changeProfile'])->name('profile-change');
    Route::put('edit/{profile}&{user}', [ProfileController::class, 'changeProfileUpdate'])->where('profile', '\d+')->where('user', '\d+')->name('profile.update');
    Route::resource('lists', ListController::class)->name('index', 'lists.index');
    Route::resource('favourite', FavouriteRecipesController::class)->name('index', 'favourite.index');
    Route::resource('recipe', UserRecipeController::class)->name('index', 'recipe.index');
});

Route::group(['prefix' => 'admin', 'as' => 'voyager.', 'middleware' => 'admin.user'], function () {
    Route::get('/parce/{resource}', ParcerController::class)->where('resource', '\d+')->name('resources.parce');
    Route::get('resources/parcer/index', ResourceController::class)->name('resources.parcer.index');
});
