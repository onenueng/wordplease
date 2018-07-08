<?php

namespace App;

use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Errorlog extends Model implements AutoId
{
    use AutoIdInsertable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'division_id',
        'permission_id',
        'valid_until',
        'granted_by',
    ];

    // protected $aa = [
    //         'type' => get_class($e),
    //         'code' => $e->getCode(),
    //         'message' => $e->getMessage(),
    //         'line' => $e->getLine(),
    //         'file' => $e->getfile()
    //     ];


}
