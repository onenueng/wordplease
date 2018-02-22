<?php

namespace App;

use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Authorize extends Model implements AutoId
{
    use AutoIdInsertable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'division_id',
        'permission_id',
        'valid_until',
        'granted_by',
    ];

    public function users()
    {
        return $this->belongsToMany('\App\User');
    }

    public function permission()
    {
        return $this->hasOne('\App\Permission');
    }
}
