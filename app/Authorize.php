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
        'role_id',
        'division_id',
    ];

    public function users()
    {
        return $this->belongsToMany('\App\User');
    }
}
