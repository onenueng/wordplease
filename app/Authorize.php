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
        'user_id',
        'division_id',
        'permission_id',
        'valid_until',
        'granted_by',
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function permission()
    {
        return $this->belongsTo('\App\Permission');
    }

    public function division()
    {
        return $this->belongsTo('\App\Models\Lists\Division');
    }
}
