<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\CountriesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\CountriesImport;
use App\Models\User;
use App\Models\User\Country;
use App\Http\Requests\User\CountriesRequest;
use App\Http\Resources\User\CountriesCollection;
use App\Http\Resources\User\CountriesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CountriesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index(Request $request)
    {
        //return $request; 
        //return $query = Country::All();
        $query = User::commonFunctionMethod(Country::class,$request);
        return new CountriesCollection(CountriesResource::collection($query),CountriesResource::class);
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
    public function store(CountriesRequest $request)
    {
       //return $request;
         new CountriesResource(Country::create($request->all()));
         return response()->json(['success' => config('constants.messages.success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return new CountriesResource($country->load([]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesRequest $request, Country $country)
    {
        //
        $country->update($request->all());

        return new CountriesResource($country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Country $country)
    {
        //
        $country->delete();

        return new DataTrueResource($country);       
    }
    public function deleteAll(Request $request)
    {
        return Country::deleteAll($request);
    }
    public function export(Request $request)
    {
        return Excel::download(new CountriesExport($request), 'country.csv');
    }
}
