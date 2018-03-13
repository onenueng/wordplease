<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Traits\DataImportable;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class NoteType extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'class', // admission/discharge/service.
        'gender', // 0 => female only/ 1 => male only/ 2 => all gender.
        'view_path',
        'table_name',
        'division_id',
        'resource_name',
    ];
}
