<?php

namespace App\Http\Controllers\API\User;
use App\Exports\User\UsersExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\UsersImport;
use App\User;
use App\Models\User\UserGallery;
use App\Http\Requests\User\UsersRequest;
use App\Http\Resources\User\UsersCollection;
use App\Http\Resources\User\UsersResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\UploadTrait;
use URL;

class UsersAPIController extends Controller
{

    /** 
    * Register New User
    */
    public function register(UsersRequest $request)
    {
        return User::Register($request);
    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UsersResource($user->load([]));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function batchRequest(Request $requestObj)
    {
        return $requestObj;
    }    
}
