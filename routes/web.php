<?php

use App\Http\Controllers\AnnotationController;
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

// Route::get('/', function () {
//     return view('welcome');
// });



// usage inside a laravel route
Route::get('/', function(){

    $img = Image::make('http://images4.fanpop.com/image/photos/17500000/cool-background-random-17506483-800-600.jpg')->resizeCanvas(300, 300);

    $jpg = Image::make('http://images4.fanpop.com/image/photos/17500000/cool-background-random-17506483-800-600.jpg');

    return $jpg->response('jpg', 100);

});


Route::get('annotate', [AnnotationController::class, 'displayForm'])->name('displayForm');
Route::post('annotate', [AnnotationController::class, 'annotateImage'])->name('annotateImage');

