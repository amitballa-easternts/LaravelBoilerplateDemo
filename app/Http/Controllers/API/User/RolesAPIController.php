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

/*
   |--------------------------------------------------------------------------
   | Roles Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the Roles of
     index,
     show,
     store,
     update,
     destroy,
     export and
     getPermissionsByRole Methods.
   |
   */

class RolesAPIController extends Controller
{
    /**
     * Roles List
     * @param Request $request
     * @return RolesCollection
     * @return RolesResource
     */

    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(Role::class, $request);
        return new RolesCollection(RolesResource::collection($query), RolesResource::class);
    }

    /**
     * Create a new Role instance after a valid Role.
     * @param RolesRequest $request
     * @return RolesResource
     */

    public function store(RolesRequest $request)
    {
        new RolesResource(Role::create($request->all()));
        return response()->json(['success' => config('constants.messages.success')]);
    }

    /**
     * Role Detail
     * @param Role $role
     * @return RolesResource
     */

    public function show(Role $role)
    {
        return new RolesResource($role->load([]));
    }

    /**
     * Update Role
     * @param RolesRequest $request
     * @param Role $role
     * @return RolesResource
     */

    public function update(RolesRequest $request, Role $role)
    {
        $role->update($request->all());

        return new RolesResource($role);
    }

    /**
     * Delete Role
     * @param Request $request
     * @param Role $role
     * @return DataTrueResource
     */

    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        return new DataTrueResource($role);
    }

    /**
     * Delete Role multiple
     * @param Request $request
     * @return DataTrueResource
     */

    public function deleteAll(Request $request)
    {
        return Role::deleteAll($request);
    }

    /**
     * Export Roles Data
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function export(Request $request)
    {
        return Excel::download(new RolesExport($request), 'role.csv');
    }

    /**
     * Role Detail
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getPermissionsByRole(Request $request)
    {
        $role = Role::findorfail($request->id); //get role details
        $allPermission = Permission::getPermissions($role);
        return response()->json(['data' => $allPermission]);
    }
}
