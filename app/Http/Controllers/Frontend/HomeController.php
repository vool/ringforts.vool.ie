<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ringfort;
use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats = array();
        
        $stats['total'] =  Ringfort::all()->count();
        
        $stats['rejected'] =  Ringfort::rejected()->count();
        $stats['rejected_pc'] =  ($stats['rejected']/$stats['total'])*100;
        
        $stats['pending'] =  Ringfort::pending()->count();
        $stats['pending_pc'] =  ($stats['pending']/$stats['total'])*100;
        
        $stats['confirmed'] =  Ringfort::confirmed()->count();
        $stats['confirmed_pc'] =  ($stats['confirmed']/$stats['total'])*100;
        
        return view('frontend.index')
            ->with('stats', $stats);
    }
    
    
    /**
     * @return \Illuminate\View\View
     */
    public function show($id){
        
        $stats = array();
        
        $stats['total'] =  Ringfort::all()->count();
        
        $stats['rejected'] =  Ringfort::rejected()->count();
        $stats['rejected_pc'] =  ($stats['rejected']/$stats['total'])*100;
        
        $stats['pending'] =  Ringfort::pending()->count();
        $stats['pending_pc'] =  ($stats['pending']/$stats['total'])*100;
        
        $stats['confirmed'] =  Ringfort::confirmed()->count();
        $stats['confirmed_pc'] =  ($stats['confirmed']/$stats['total'])*100;
        
        return view('frontend.index')
            ->with('stats', $stats)
            ->with('entityID', $id);
    }
}
