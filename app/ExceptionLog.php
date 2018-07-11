<?php

namespace App;

use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class ExceptionLog extends Model implements AutoId
{
    use AutoIdInsertable;

    protected $dateFormat = 'Y-m-d H:i:s.u';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'route',
        'file',
        'code',
        'type',
        'line',
        'message',
    ];
}
