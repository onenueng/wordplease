<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Traits\AutoIdInsertable;
use App\Models\Lists\DrugRegimen;
use Illuminate\Database\Eloquent\Model;

// class ICDItem extends Model implements AutoId, ListItem
class ICDItem extends Model implements ListItem
{
    // use AutoIdInsertable, ListQueryable;
    use ListQueryable;

    // protected $dateFormat = 'Y-m-d H:i:s.u';
    
    protected $table = 'icd_items';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'string'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * Get fields whiches selected for query.
     *
     * @return array
     */
    public static function selectFields()
    {
        if ( config('database.default') == 'sqlsrv' ) {
            return "id as data, id + ' | ' + name as value";
        } else {
            return "id as data, CONCAT(id, ' | ', name) as value";
        }
    }
}
