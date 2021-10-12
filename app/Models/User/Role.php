<?php

namespace App\Models\User;

use App\Http\Resources\DataTrueResource;
use App\Traits\Scopes;
use App\Traits\CreatedbyUpdatedby;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use Scopes,SoftDeletes,CreatedbyUpdatedby;

    //public $timestamps = false;
    public $sortable=[
        'name','id'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'guard_name', 'landing_page'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
        'id' =>'string',
    ];

    /**
     * Get the Users for the Role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the Permissions for the Role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,"permission_role","role_id","permission_id");
    }

    /**
     * Multiple Delete
     * @param $query
     * @param $request
     * @return DataTrueResource|\Illuminate\Http\JsonResponse
     */
    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            Role::whereIn('id', $request->id)->delete();

            return new DataTrueResource(true);
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
