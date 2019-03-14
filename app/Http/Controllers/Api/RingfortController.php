<?php

namespace App\Http\Controllers\Api;

use App\Models\Ringfort;
use App\Http\Controllers\Controller;

/**
 * Class RingfortController.
 */
class RingfortController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $ringforts = Ringfort::where('status', '>=', '0')->get()
            //$ringforts = Ringfort::take(10)->get()
            ->map(function ($item) {
                $f = [];

                foreach (['id', 'entity_id', 'status', 'latlng'] as $col) {
                    $f[$col] = $item[$col];
                }

                return $f;
            });

        return $ringforts;

        return response()->json($ringforts);
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show($entity_id)
    {
        $ringfort = Ringfort::where('entity_id', '=', $entity_id)->first();

        //dd($ringfort);
        return response()->json($ringfort);
    }
}
