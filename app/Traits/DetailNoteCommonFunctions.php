<?php

namespace App\Traits;

use App\Models\Notes\Note;

trait DetailNoteCommonFunctions
{
    public function header()
    {
        return $this->belongsTo(Note::class, 'id');
    }

    public function genExtraFields()
    {
        foreach ($this->selectItemFields as $field) {
            $name = $field . '_text';
            $this->$name = $this->$field
                ? app('db')->table('select_items')
                ->select('label')
                ->where(['field_name' => $field, 'value' => $this->$field])
                ->first()
                ->label
                : null;
        }
    }

    public function autosave($field, $value)
    {
        if (array_search($field, $this->selectItemFields) !== false && $value !== null) {
            $this->$field = $this->getSelectItemValue($field, $value);
        } else {
            $this->$field = $value;
        }

        $this->resetExtrasIfNeeded($field, $value);
        $this->save();
        $this->header->touch();
        return $field;
    }

    protected function resetExtrasIfNeeded($field, $value)
    {
        if (array_key_exists($field, $this->fieldsWithExtras)
            && in_array($value, $this->fieldsWithExtras[$field]['resetTriggerValues'])) {
            foreach ($this->fieldsWithExtras[$field]['fields'] as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    protected function getSelectItemValue($field, $value)
    {
        $item = app('db')->table('select_items')
            ->select('value')
            ->where(['field_name' => $field, 'label' => $value])
            ->first();

        if ($item === null) {
            $item = \App\Models\Lists\SelectItem::insert([
                'field_name' => $field,
                'value' => \App\Models\Lists\SelectItem::where('field_name', $field)->count() + 1,
                'label' => $value,
                'order' => 0,
                'active' => false,
            ]);
            $item = \App\Models\Lists\SelectItem::where(['field_name' => $field, 'label' => $value])->first();
        }

        return $item->value;
    }
}