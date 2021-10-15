<?php

namespace App\Http\Controllers\API\User;

use App\Models\User\Permission;
use App\Http\Resources\User\PermissionsCollection;
use App\Http\Resources\User\PermissionsResource;
use App\Http\Requests\User\PermissionsRequest;
use App\Http\Requests\User\SetUnsetPermissionToRoleRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\DataTrueResource;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\User\PermissionsExport;

/*
   |--------------------------------------------------------------------------
   | Permission Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the Permissions of index, show, store, update, destroy, setUnsetPermissionToRole and Export Methods.
   |
   */

class PermissionsAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(Permission::class, $request);
        return new PermissionsCollection(PermissionsResource::collection($query), PermissionsResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PermissionsRequest $request)
    {
        return new PermissionsResource(Permission::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Permission $permission)
    {
        return new PermissionsResource($permission);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PermissionsRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        return new PermissionsResource($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();
        return new DataTrueResource($permission);
    }

    /**
     * Delete Permission multiple
     * @param Request $request
     * @return DataTrueResource
     */

    public function deleteAll(Request $request)
    {
        return Permission::deleteAll($request);
    }

    /**
     * This method is used set/unset permission to role
     *
     * @param SetUnsetPermissionToRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function setUnsetPermissionToRole(SetUnsetPermissionToRoleRequest $request)
    {
        return Permission::setUnsetPermission($request);
    }
}
