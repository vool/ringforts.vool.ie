<?php

use Illuminate\Http\Request;
use App\Models\Ringfort;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/ringforts', 'Api\RingfortController@index');

Route::middleware('api')->get('/ringforts/{entity_id}', 'Api\RingfortController@show');
