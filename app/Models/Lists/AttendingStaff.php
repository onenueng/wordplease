<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Models\Notes\Note;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Models\Lists\Division;
use App\Traits\AutoIdInsertable;
use App\Traits\RuntimeMaintainable;
use Illuminate\Database\Eloquent\Model;

class AttendingStaff extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, RuntimeMaintainable, ListQueryable;

    // protected $dateFormat = 'Y-m-d H:i:s.u';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'division_id',
        'licence_no',
        'active'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
