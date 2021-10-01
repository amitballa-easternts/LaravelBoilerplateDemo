<?php

namespace App;

use App\Http\Resources\User\UsersResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{

    protected $table = 'users';

    protected $fillable = [
        'id', 'name', 'email', 'password', 'mobile_no', 'gender', 'dob', 'address', 'status'
    ];

    public function scopeRegister($query,$request){
         $data = $request->all();
         $data['password'] = bcrypt($data['password']);
         $user = User::create($data);
         return response()->json(['success' => config('constants.messages.success')], config('constants.validation_codes.ok'));


    }

}
