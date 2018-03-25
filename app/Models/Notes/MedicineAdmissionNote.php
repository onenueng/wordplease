<?php

namespace App\Models\Notes;

use App\Models\Notes\Note;
use Illuminate\Database\Eloquent\Model;

class MedicineAdmissionNote extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'UUID'];

    protected $slecteItemFields = ['admit_reason'];

    public function header()
    {
        return $this->belongsTo(Note::class, 'id');
    }

    public function genExtraFields()
    {
        foreach ($this->slecteItemFields as $field) {
            $name = $field . '_text';
            $this->$name = $this->$field 
                            ? app('db')->table('select_items')
                                       ->select('label')
                                       ->where('field_name', $field)
                                       ->where('value', $this->$field)
                                       ->first()
                                       ->label  
                            : null;
        }
    }
}
