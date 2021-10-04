<?php

namespace App;
use App\Http\Resources\DataTrueResource;
use App\Http\Resources\User\UsersResource;
use App\Models\User\Country;
use App\Models\User\Hobby;
use App\Models\User\State;
use App\Models\User\City;
use App\Models\User\Role;
use App\Models\User\UserGallery;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Scopes;
use Laravel\Passport\HasApiTokens;
use App\Traits\UploadTrait;

class User extends Authenticatable implements MustVerifyEmail
{

    protected $table = 'users';
/* Scope Of Countries */
    public function scopeCommonFunctionMethod($query, $model, $request, $preQuery = null, $tablename = null, $groupBy = null, $export_select = false, $no_paginate = false)
    {
        return $this->getCommonFunctionMethod($model, $request, $preQuery, $tablename , $groupBy , $export_select , $no_paginate);
    }

    protected $fillable = [
        'id', 'name', 'email', 'password', 'mobile_no', 'gender', 'dob', 'address', 'status'
    ];

    public function scopeRegister($query,$request){
         $data = $request->all(); 
         $data['password'] = bcrypt($data['password']);
         $user = User::create($data);
         return response()->json(['success' => config('constants.messages.success')], config('constants.validation_codes.ok'));


    }
    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function state() {
        return $this->belongsTo(State::class);
    }



}
