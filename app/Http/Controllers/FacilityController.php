<?php

namespace App\Http\Controllers;

use App\Facility;
use App\SubCounty;
use App\County;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all facilities

        $facilities = Facility::all();

        return response()->json($facilities);
    }

    /**
     * Display all facilities in a sub county in a county.
     *
     * @return \Illuminate\Http\Response
     */
    public function org_units()
    {
        //get all facilities
        
        $ITEMS_PER_PAGE = 100;

        $facilities = Facility::latest()->paginate($ITEMS_PER_PAGE);
        foreach($facilities as $facility)
                {
                    $facility->sub_county_name = $facility->subCounty->name;
                    $facility->county_name = $facility->subCounty->county->name;
                }

        return response()->json($facilities);
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
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        //
    }
}
