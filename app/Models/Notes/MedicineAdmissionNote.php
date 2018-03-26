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

    public function autosave($field, $value)
    {
        if ( $value === null ) {
            $this->$field = null;
            return $this->save();
        }

        $selectItemFields = ['admit_reason'];

        if ( array_search($field, $selectItemFields) !== false ) {
            $item = app('db')->table('select_items')->select('value')->where(['field_name' => $field, 'label' => $value])->first();
            if ( $item === null ) {
                $item = \App\Models\Lists\SelectItem::insert([
                            'field_name' => $field,
                            'value' => \App\Models\Lists\SelectItem::where('field_name', $field)->count() + 1,
                            'label' => $value,
                            'order' => 0,
                            'active' => false,
                        ]);
                $item = \App\Models\Lists\SelectItem::where(['field_name' => $field, 'label' => $value])->first();
            }
            $this->$field = $item->value;
        } else {
            $this->$field = $value;
        }

        return $this->save();
    }
}
