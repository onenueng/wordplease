<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class SelectItem extends Model
{

    public $timestamps = false;
    
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
