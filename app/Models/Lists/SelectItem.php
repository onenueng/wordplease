<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DataImportable;

class SelectItem extends Model
{
    use DataImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'field_name',
        'value',
        'label',
        'order',
        'active'
    ];
}
