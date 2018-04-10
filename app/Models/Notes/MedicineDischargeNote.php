<?php

namespace App\Models\Notes;

use App\Traits\DetailNoteCommonFunctions;
use Illuminate\Database\Eloquent\Model;

class MedicineDischargeNote extends Model
{
    use DetailNoteCommonFunctions;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'UUID'];

    public $timestamps = false;

    protected $selectItemFields = [
        'admit_reason',
        'discharge'
    ];

    protected $fieldsWithExtras = [];
}
