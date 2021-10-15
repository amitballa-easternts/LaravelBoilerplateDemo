<?php

namespace App\Models;

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
    use Notifiable, Scopes, HasApiTokens, SoftDeletes, UploadTrait;

    protected $table = 'users';
    /* Scope Of Countries */
    public function scopeCommonFunctionMethod($query, $model, $request, $preQuery = null, $tablename = null, $groupBy = null, $export_select = false, $no_paginate = false)
    {
        return $this->getCommonFunctionMethod($model, $request, $preQuery, $tablename, $groupBy, $export_select, $no_paginate);
    }
    public static function getCommonFunctionMethod($model, $request, $preQuery = null, $tablename = null, $groupBy = null, $export_select = false, $no_paginate = false)
    {
        if (is_null($preQuery)) {
            $mainQuery = $model::withSearch($request->get('search'), $export_select);
        } else {
            $mainQuery = $model->withSearch($request->get('search'), $export_select);
        }
        if ($request->filled('filter') != '')
            $mainQuery = $mainQuery->withFilter($request->get('filter'));
        if (!is_null($groupBy))
            $mainQuery = $mainQuery->groupBy($groupBy);
        if ($no_paginate) {
            return $mainQuery->withOrderBy($request->get('sort'), $request->get('order_by'), $tablename, $export_select);
        } else {
            return $mainQuery->withOrderBy($request->get('sort'), $request->get('order_by'), $tablename, $export_select)
                ->withPerPage($request->get('per_page'));
        }
    }
    protected $fillable = [
        'id', 'name', 'email', 'password', 'mobile_no', 'role_id', 'profile', 'gender', 'dob', 'address', 'country_id', 'state_id', 'city_id', 'status', 'remember_token'
    ];
    /**
     * @var array
     */
    public $sortable = [
        'id', 'name', 'email', 'mobile_no', 'gender', 'dob', 'address'
    ];

    public $foreign_sortable = [
        'country_id', 'state_id', 'city_id'
    ];

    public $foreign_table = [
        'countries', 'states', 'cities'
    ];

    public $foreign_key = [
        'name', 'name', 'name'
    ];

    public $foreign_method = [
        'country', 'state', 'city'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['email_verified_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
        'id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'mobile_no' => 'string',
        'role_id' => 'string',
        'profile' => 'string',
        'gender' => 'string',
        'dob' => 'string',
        'address' => 'string',
        'country_id' => 'string',
        'state_id' => 'string',
        'city_id' => 'string',
        'status' => 'string',
        'email_verified_at' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string',
    ];
    public function getProfileAttribute($value)
    {
        if ($value == NULL)
            return "";
        return url(config('constants.image.dir_path') . $value);
    }

    public function scopeRegister($query, $request)
    {
        //return dd($request);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        if ($request->hasfile('profile')) {
            $path = $this->uploadOne($request->file('profile'), '/public/user/' . $user->id);
            $user->update(['profile' => $path]);
        }
        if ($data['hobby']) {
            $user->hobbies()->attach($data['hobby']); //this executes the insert-query
        }

        if ($request->hasfile('gallery')) {
            foreach ($request->gallery as $image) {
                $path = $this->uploadOne($image, '/public/user/' . $user->id);
                UserGallery::create(['user_id' => $user->id, 'filename' => $path]);
            }
        }

        $user->sendEmailVerificationNotification();
        return response()->json(['success' => config('constants.messages.success')], config('constants.validation_codes.ok'));
    }

    public function scopeUpdateUser($query, $request, $user)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        if ($request->hasfile('profile')) {
            $this->deleteOne('/public/user/' . $user->id . '/' . basename($user->profile));
            $path = $this->uploadOne($request->file('profile'), '/public/user/' . $user->id);
            $user->update(['profile' => $path]);
        }

        if ($request->hasfile('gallery')) {
            foreach ($request->gallery as $image) {
                $path = $this->uploadOne($image, '/public/user/' . $user->id);
                UserGallery::create(['user_id' => $user->id, 'filename' => $path]);
            }
        }

        if ($data['hobby']) {
            $user->hobbies()->detach(); //this executes the delete-query
            $user->hobbies()->attach($data['hobby']); //this executes the insert-query
        }

        $user->update($data);
        return new UsersResource($user);
    }
    public function scopeDeleteAll($query, $request)
    {
        if (!empty($request->id)) {
            User::whereIn('id', $request->id)->delete();

            return new DataTrueResource(true);
        } else {
            return response()->json(['error' => config('constants.messages.delete_multiple_error')], config('constants.validation_codes.422'));
        }
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, "user_hobbies", "user_id", "hobby_id");
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
