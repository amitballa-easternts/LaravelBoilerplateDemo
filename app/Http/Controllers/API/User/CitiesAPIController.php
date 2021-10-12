<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\CitiesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\CitiesImport;
use App\Models\User;
use App\Models\User\City;
use App\Http\Requests\User\CitiesRequest;
use App\Http\Resources\User\CitiesCollection;
use App\Http\Resources\User\CitiesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CitiesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
         //$query = City::All();
         $query = User::commonFunctionMethod(City::class,$request);
         return new CitiesCollection(CitiesResource::collection($query),CitiesResource::class);
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
    public function store(CitiesRequest $request)
    {
        //
         new CitiesResource(City::create($request->all()));
        return response()->json(['success' => config('constants.messages.success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        
        return new CitiesResource($city->load([]));
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
    public function update(CitiesRequest $request, City $city)
    {
        //
     
        $city->update($request->all());

        return new CitiesResource($city);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, City $city)
    {
        $city->delete();

        return new DataTrueResource($city);
    }
    public function deleteAll(Request $request)
    {
        return City::deleteAll($request);
    }
    public function export(Request $request)
    {
        return Excel::download(new CitiesExport($request), 'city.csv');
    }
}
