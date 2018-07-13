<?php

namespace App\Models\Lists;

use App\User;
use App\Contracts\AutoId;
use App\Models\Notes\Note;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Models\Lists\NoteType;
use App\Traits\AutoIdInsertable;
use App\Models\Lists\AttendingStaff;
use Illuminate\Database\Eloquent\Model;

class Division extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, ListQueryable;

    // protected $dateFormat = 'Y-m-d H:i:s.u';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'name_eng',
        'name_eng_short',
    ];

    /**
     * Get fields whiches make where(or) in the query.
     *
     * @return array
     */
    public static function whereFields()
    {
        return ['name', 'name_eng'];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function noteTypes()
    {
        return $this->hasMany(NoteType::class);
    }

    public function staffs()
    {
        return $this->hasMany(AttendingStaff::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
