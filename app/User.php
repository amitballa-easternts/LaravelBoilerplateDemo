<?php

namespace App;

use App\Http\Resources\User\UsersResource;

use App\Models\User\UserGallery;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{

    protected $table = 'users';

    protected $fillable = [
        'id', 'name', 'mobile_no'
    ];

    public function scopeRegister($query,$request){
         $data = $request->all();
         $user = User::create($data);
         return response()->json(['success' => config('constants.messages.success')], config('constants.validation_codes.ok'));


    }

}
