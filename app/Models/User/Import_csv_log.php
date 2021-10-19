<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Scopes;

class Import_csv_log extends Model
{
    use Scopes, SoftDeletes;
    protected $table = 'import_csv_logs';


    //public $timestamps = false;
    public $sortable = [
        'filename', 'file_path', 'model_name', 'error_log'
    ];

    /**
     * @var array
     */

    protected $fillable = ['filename', 'file_path', 'model_name', 'error_log'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
        'id' => 'string',
        'filename' => 'string',
        'file_path' => 'string',
        'model_name' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string'
    ];

    /**
     * @param $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getFilePathAttribute($value)
    {
        if ($value == NULL)
            return "";
        return url(config('constants.image.dir_path') . $value);
    }
}
