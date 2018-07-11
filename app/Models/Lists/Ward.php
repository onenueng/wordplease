<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Models\Notes\Note;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Traits\AutoIdInsertable;
use App\Traits\RuntimeMaintainable;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, RuntimeMaintainable, ListQueryable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'name_short',
        'active',
    ];

    /**
     * Get fields whiches make where(or) in the query.
     *
     * @return array
     */
    public static function whereFields()
    {
        return ['name', 'name_short'];
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
