<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ringfort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RingfortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ringforts = Ringfort::paginate();
        
        return view('backend.ringforts.index')->with('ringforts', $ringforts);
    }
    
    /**
     * Display a listing of confirmed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfirmed()
    {
        $ringforts = Ringfort::confirmed()->paginate();
        
        return view('backend.ringforts.index')->with('ringforts', $ringforts);
    }
    
    /**
     * Display a listing of pending resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPending()
    {
        $ringforts = Ringfort::pending()->paginate();
        
        return view('backend.ringforts.index')->with('ringforts', $ringforts);
    }
    
    /**
     * Display a listing of rejected resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRejected()
    {
        $ringforts = Ringfort::rejected()->paginate();
        
        return view('backend.ringforts.index')->with('ringforts', $ringforts);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ringfort  $ringfort
     * @return \Illuminate\Http\Response
     */
    public function show(ringfort $ringfort)
    {
        return view('backend.ringforts.show')->with('ringfort', $ringfort);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ringfort  $ringfort
     * @return \Illuminate\Http\Response
     */
    public function edit(ringfort $ringfort)
    {
        return view('backend.ringforts.edit')->with('ringfort', $ringfort);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ringfort  $ringfort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ringfort $ringfort)
    {
        //
        
        $ringfort->new_lat = $request->lat;
        
        $ringfort->new_long = $request->long;
        
        if ($ringfort->save()) {
            return redirect()->back()->withFlashSuccess("Location updated");
        } else {
            return redirect()->back()->withFlashSuccess("Failed");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ringfort  $ringfort
     * @return \Illuminate\Http\Response
     */
    public function destroy(ringfort $ringfort)
    {
        //
    }
    
    /**
     * @param ManageUserRequest $request
     * @param User              $user
     * @param                   $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(Request $request, Ringfort $ringfort, $status)
    {
        $ringfort->status = $status;
        
        if ($ringfort->save()) {
            return redirect()->back()->withFlashSuccess("Location updated");
        } else {
            return redirect()->back()->withFlashSuccess("Failed");
        }
    }
}
