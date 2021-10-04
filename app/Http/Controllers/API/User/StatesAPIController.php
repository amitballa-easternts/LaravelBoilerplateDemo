<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\StatesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\StatesImport;
use App\User;
use App\Models\User\State;
use App\Http\Requests\User\StatesRequest;
use App\Http\Resources\User\StatesCollection;
use App\Http\Resources\User\StatesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class StatesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $request;
        return $query = State::All();
      /*   $query = User::commonFunctionMethod(State::class,$request);
        return new StatesCollection(StatesResource::collection($query),StatesResource::class); */
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
    public function store(StatesRequest $request)
    {
         //dd($request->all());
        return new StatesResource(State::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(StatesRequest $request, State $state)
    {
        $state->update($request->all());

        return new StatesResource($state);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, State $state)
    {
        //
        //return $state;
        $state->delete();

        return new DataTrueResource($state);

    }
    public function deleteAll(Request $request)
    {
        return $request;
    }
}
