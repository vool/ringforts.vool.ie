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

Route::middleware('api')->get('/ringforts', function () {
    $ringforts = Ringfort::all()
        //$ringforts = Ringfort::take(10)->get()
        ->map(function ($item) {
            $f = [];
            
            foreach (['id', 'entity_id', 'status', 'latlng'] as $col) {
                $f[$col] = $item[$col];
            }
            
            return $f;
        });
        
    return $ringforts;
});

Route::middleware('api')->get('/ringforts/{entity_id}', function (Request $request) {
    $ringfort = Ringfort::where('entity_id', '=', $request->entity_id)->first();

    return $ringfort;
});
