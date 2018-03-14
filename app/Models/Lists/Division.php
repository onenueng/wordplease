<?php

namespace App\Models\Lists;

use App\User;
use App\Models\Lists\NoteType;
use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Traits\DataImportable;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Division extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, DataImportable, ListQueryable;

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
}
