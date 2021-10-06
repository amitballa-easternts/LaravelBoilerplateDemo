<?php

namespace App\Models\User;
use App\Http\Resources\DataTrueResource;
use App\Traits\Scopes;
use App\Traits\CreatedbyUpdatedby;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes, Scopes,CreatedbyUpdatedby;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'name','country_id'
    ];

    /**
     * @var array
     */
    public $sortable=[
        'id','name'
    ];

    /**
     * @var array
     */
    public $foreign_sortable = [
        'country_id'
    ];

    /**
     * @var array
     */
    public $foreign_table = [
        'countries'
    ];

    /**
     * @var array
     */
    public $foreign_key = [
        'name'
    ];

    /**
     * @var array
     */
    public $foreign_method = [
        'country'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
        'id'=>'string',
        'country_id'=>'string',
        'name'=>'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country() {
        return $this->belongsTo(Country::class);
    }

    /**
     * Multiple Delete
     * @param $query
     * @param $request
     * @return DataTrueResource|\Illuminate\Http\JsonResponse
     */
    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            State::whereIn('id', $request->id)->delete();

            return new DataTrueResource(true);
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
