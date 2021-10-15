<?php

namespace App\Http\Controllers\API\User;

use App\Exports\User\UsersExport;
use App\Http\Resources\DataTrueResource;
use App\Imports\User\UsersImport;
use App\Models\User;
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

/*
 |--------------------------------------------------------------------------
 | Users Controller
 |--------------------------------------------------------------------------
 |
 | This controller handles the Roles of
     register,
     index,
     show,
     store,
     update,
     destroy,
     export Methods.
 |
 */

class UsersAPIController extends Controller
{
    use UploadTrait;
    /**
     * List All Users
     * @param Request $request
     * @return UsersCollection
     */
    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(User::class, $request);
        return new UsersCollection(UsersResource::collection($query), UsersResource::class);
    }
    /***
     * Register New User
     * @param UsersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UsersRequest $request)
    {
        return User::Register($request);
    }

    /**
     * Users detail
     * @param User $user
     * @return UsersResource
     */

    public function show(User $user)
    {
        return new UsersResource($user->load([]));
    }

    /**
     * Update Users
     * @param UsersRequest $request
     * @param User $user
     * @return UsersResource
     */

    public function update(UsersRequest $request, User $user)
    {
        return User::UpdateUser($request, $user);
    }

    /**
     * Delete User
     *
     * @param Request $request
     * @param User $user
     * @return DataTrueResource
     * @throws \Exception
     */

    public function destroy(Request $request, User $user)
    {
        //return dd($id);
        $user->hobbies()->detach();

        Storage::deleteDirectory('/public/user/' . $user->id);
        UserGallery::where('user_id', $user->id)->delete();

        Storage::deleteDirectory('/public/user/' . $user->id);
        $user->delete();

        return new DataTrueResource($user);
    }

    /**
     * Delete User multiple
     * @param Request $request
     * @return DataTrueResource
     */

    public function deleteAll(Request $request)
    {
        return User::deleteAll($request);
    }

    /**
     * Export Users Data
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function export(Request $request)
    {
        return Excel::download(new UsersExport($request), 'user.csv');
    }
}
