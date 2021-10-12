<?php

namespace App\Http\Controllers\Api\User; 

use App\Http\Requests\User\LoginRequest;
use \App\Http\Resources\User\LoginResource;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Resources\DataTrueResource;

use App\Models\User;
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

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($user != null){
            $token->scopes = $user->role->permissions->pluck('name')->toArray();
            $token->save();
            $role = Role::findorfail($user->role_id);//get role details
            $user->permissions = Permission::getPermissions($role,$isSubscription = true);
            $user->authorization = $tokenResult->accessToken;
            return new LoginResource($user);
        }else{
            return response("No User found.", config('constants.validation_codes.unprocessable_entity') );
        }

    }
    public function changePassword(ChangePasswordRequest $request)
    {
        
        //get all updated data.
        //dd($request);
        $data = $request->all();
        //dd($request->email);
        $masterUser = User::where('email', $request->email)->first();
        if (Hash::check($data['old_password'], $masterUser->password)) {
            $masterData['password'] = bcrypt($data['new_password']);
            //update user password in master user table
            if ($masterUser->update($masterData))
                return new DataTrueResource($masterUser);
            else
                return response()->json(['error' => config("constants.messages.something_wrong")],config('constants.validation_codes.unprocessable_entity'));
        }
        else
            return response()->json(['error' => config("constants.messages.invalid_old_password")],config('constants.validation_codes.unprocessable_entity'));

    }
    public static function logout(Request $request) {
      
        $token = $request->user()->token();
        $token->revoke();
        return response()->json('You have been Successfully logged out!');
    }
}
