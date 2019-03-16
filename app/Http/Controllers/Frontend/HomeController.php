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

        $stats['rejected_pc'] =  $stats['pending_pc'] = $stats['confirmed_pc'] = 0;

        $stats['total'] =  Ringfort::withTrashed()->count();

        $stats['deleted'] =  Ringfort::onlyTrashed()->count();

        $stats['rejected'] =  Ringfort::rejected()->count();

        $stats['pending'] =  Ringfort::pending()->count();

        $stats['confirmed'] =  Ringfort::confirmed()->count();

        if ($stats['total'] > 0) {
            $stats['rejected_pc'] =  ($stats['rejected']/$stats['total'])*100;

            $stats['pending_pc'] =  ($stats['pending']/$stats['total'])*100;

            $stats['confirmed_pc'] =  ($stats['confirmed']/$stats['total'])*100;

            $stats['deleted_pc'] =  ($stats['deleted']/$stats['total'])*100;
        }

        return view('frontend.index')
            ->with('stats', $stats);
    }


    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $stats = array();

        $stats['total'] =  Ringfort::withTrashed()->count();

        $stats['rejected'] =  Ringfort::rejected()->count();
        $stats['rejected_pc'] =  ($stats['rejected']/$stats['total'])*100;

        $stats['pending'] =  Ringfort::pending()->count();
        $stats['pending_pc'] =  ($stats['pending']/$stats['total'])*100;

        $stats['confirmed'] =  Ringfort::confirmed()->count();
        $stats['confirmed_pc'] =  ($stats['confirmed']/$stats['total'])*100;

        $stats['deleted'] =  Ringfort::onlyTrashed()->count();
        $stats['deleted_pc'] =  ($stats['deleted']/$stats['total'])*100;

        return view('frontend.index')
            ->with('stats', $stats)
            ->with('entityID', $id);
    }
}
