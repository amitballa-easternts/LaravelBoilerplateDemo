<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\User\LoginRequest;
use \App\Http\Resources\User\LoginResource;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Resources\DataTrueResource;

use App\User;
use App\Models\User\Role;
use App\Models\User\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'error' => config('constants.messages.user.invalid')
            ], config('constants.validation_codes.unprocessable_entity'));
        $user = $request->user();

        if ((isset($user) && $user->status != config('constants.user.status_code.active'))) {
            return response()->json(['error' => config('constants.messages.login.unverified_account')],config('constants.validation_codes.unprocessable_entity'));
        }

        //$tokenResult = $user->createToken('Personal Access Token');
        //$token = $tokenResult->token;

        if($user != null){
            //get User Permission and save permission in token
/*             $token->scopes = $user->role->permissions->pluck('name')->toArray();
            $token->save();
            $role = Role::findorfail($user->role_id);//get role details
            $user->permissions = Permission::getPermissions($role,$isSubscription = true);
            $user->authorization = $tokenResult->accessToken; */
            return new LoginResource($user);
        }else{
            return response("No User found.", config('constants.validation_codes.unprocessable_entity') );
        }

    }
}
