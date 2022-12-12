<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;

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
Route::get('/test', function(){
    $string = "function";
    $new_string = '';
    for($i = strlen($string) - 1; $i>=0; $i--){
        $new_string .= $string[$i];
    }
    dd($new_string);
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('import', [ShiftController::class, 'import']);
Route::post('upload', [ShiftController::class, 'upload']);

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
