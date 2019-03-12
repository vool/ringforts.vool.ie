<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ringfort;
use App\Http\Controllers\Controller;


/**
 * Class HeatmapController.
 */
class SwipeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $ringforts = Ringfort::take(10)->get();
     
        return view('frontend.swipe')
            ->with('ringforts', $ringforts);
    }
}
