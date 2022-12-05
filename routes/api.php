<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employee', [ShiftController::class, 'employee']);
Route::get('shifts/truncate', [ShiftController::class, 'truncate']);
Route::get('shift-types', [ShiftController::class, 'get_shift_types']);
Route::get('shift-statuses', [ShiftController::class, 'get_shift_statuses']);
Route::resource('shifts', ShiftController::class);
