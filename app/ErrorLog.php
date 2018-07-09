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
        'file',
        'code',
        'type',
        'line',
        'message',
    ];

    // protected $aa = [
    //         'type' => get_class($e),
    //         'code' => $e->getCode(),
    //         'message' => $e->getMessage(),
    //         'line' => $e->getLine(),
    //         'file' => $e->getfile()
    //     ];


}
