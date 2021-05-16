<?php

use App\Http\Livewire\Ingredient;
use App\Http\Livewire\Photo;
use App\Http\Livewire\Recipe;
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

Route::get('/', Photo::class);
Route::get('ingredients', Ingredient::class);
Route::get('recipes',Recipe::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
