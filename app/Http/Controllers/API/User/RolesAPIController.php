<?php

namespace App\Http\Controllers\API\User;

use App\Models\User\Role;
use App\Models\User\Permission;
use App\Models\User;
use App\Http\Requests\User\RolesRequest;
use App\Http\Resources\User\RolesCollection;
use App\Http\Resources\User\RolesResource;
use Illuminate\Http\Request;
use App\Http\Resources\DataTrueResource;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\User\RolesExport;

class RolesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(Role::class,$request);
        return new RolesCollection(RolesResource::collection($query),RolesResource::class);
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
    public function store(RolesRequest $request)
    {
         new RolesResource(Role::create($request->all()));
         return response()->json(['success' => config('constants.messages.success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return new RolesResource($role->load([]));
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
    public function update(RolesRequest $request, Role $role)
    {
        $role->update($request->all());

        return new RolesResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        return new DataTrueResource($role);
    }
    public function deleteAll(Request $request)
    {
        return Role::deleteAll($request);
    }
    
    public function export(Request $request)
    {
        return Excel::download(new RolesExport($request), 'role.csv');
    }
    public function getPermissionsByRole(Request $request)
    {
        $role = Role::findorfail($request->id);//get role details
        $allPermission = Permission::getPermissions($role);
        return response()->json(['data' => $allPermission]);
    }
}
