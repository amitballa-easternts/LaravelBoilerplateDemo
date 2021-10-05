<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\HobbiesExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\HobbiesImport;
use App\User;
use App\Models\User\Hobby;
use App\Http\Requests\User\HobbiesRequest;
use App\Http\Resources\User\HobbiesCollection;
use App\Http\Resources\User\HobbiesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class HobbiesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(HobbiesRequest $request)
    {
        //return $request;
        return new HobbiesResource(Hobby::create($request->all()));
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
    public function update(HobbiesRequest $request, Hobby $hobby)
    {
        $hobby->update($request->all());

        return new HobbiesResource($hobby);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Hobby $hobby)
    {
        $hobby->delete();

        return new DataTrueResource($hobby);
    }

    public function deleteAll(Request $request)
    {
        return Hobby::deleteAll($request);
    }
}
