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

class UsersAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(User::class,$request);
        return new UsersCollection(UsersResource::collection($query),UsersResource::class);
    }
    public function register(UsersRequest $request)
    {
        return User::Register($request);
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
        return $user;
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
    public function update(UsersRequest $request, User $user)
    {
        return User::UpdateUser($request,$user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
        //return dd($id);
        $user->hobbies()->detach();

        Storage::deleteDirectory('/public/user/' . $user->id);
        UserGallery::where('user_id', $user->id)->delete();

        Storage::deleteDirectory('/public/user/' . $user->id);
        $user->delete();

        return new DataTrueResource($user);
    }
   public function deleteAll(Request $request)
    {
        return User::deleteAll($request);
    }
    public function export(Request $request)
    {
        return Excel::download(new UsersExport($request), 'user.csv');
    }
}
