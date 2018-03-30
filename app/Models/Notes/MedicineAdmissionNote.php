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

    public $timestamps = false;

    protected $selectItemFields = [
        'admit_reason',
        'comorbid_stroke_ischemic',
        'comorbid_stroke_hemorrhagic',
        'comorbid_stroke_iembolic',
        'comorbid_CKD_stage',
        'comorbid_lymphoma_specific'
    ];

    protected $fieldsWithExtras = [
        'comorbid_DM' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_DM_type' => null,
                'comorbid_DM_DR' => false,
                'comorbid_DM_nephropathy' => false,
                'comorbid_DM_neuropathy' => false,
                'comorbid_DM_diet' => false,
                'comorbid_DM_oral_meds' => false,
                'comorbid_DM_insulin' => false
            ]
        ],

        'comorbid_valvular_heart_disease' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_valvular_heart_disease_AS' => false,
                'comorbid_valvular_heart_disease_AR' => false,
                'comorbid_valvular_heart_disease_MS' => false,
                'comorbid_valvular_heart_disease_MR' => false,
                'comorbid_valvular_heart_disease_TR' => false,
                'comorbid_valvular_heart_disease_other' => false
            ]
        ],

        'comorbid_cirrhosis' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_cirrhosis_child_pugh_score' => null,
                'comorbid_cirrhosis_HBV' => false,
                'comorbid_cirrhosis_HCV' => false,
                'comorbid_cirrhosis_NASH' => false,
                'comorbid_cirrhosis_cryptogenic' => false,
                'comorbid_cirrhosis_other' => null
            ]
        ],

        'comorbid_lukemia' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_lukemia_specific' => null
            ]
        ],

        'comorbid_ICD' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_ICD_other' => null
            ]
        ],

        'comorbid_dementia' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_dementia_other' => null,
                'comorbid_dementia_vascular' => false,
                'comorbid_dementia_alzheimer' => false
            ]
        ],

        'comorbid_stroke' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_stroke_ischemic' => null,
                'comorbid_stroke_hemorrhagic' => null,
                'comorbid_stroke_iembolic' => null
            ]
        ],

        'comorbid_CKD' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_CKD_stage' => null
            ]
        ],

        'comorbid_HIV' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_HIV_TB' => false,
                'comorbid_HIV_PCP' => false,
                'comorbid_HIV_candidiasis' => false,
                'comorbid_HIV_CMV' => false,
                'comorbid_HIV_other' => null
            ]
        ],

        'comorbid_lymphoma' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_lymphoma_specific' => null
            ]
        ],

        'comorbid_cancer' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_cancer_lung' => false,
                'comorbid_cancer_liver' => false,
                'comorbid_cancer_colon' => false,
                'comorbid_cancer_breast' => false,
                'comorbid_cancer_prostate' => false,
                'comorbid_cancer_cervix' => false,
                'comorbid_cancer_pancreas' => false,
                'comorbid_cancer_brain' => false,
                'comorbid_cancer_other' => null
            ]
        ],

        'comorbid_other_autoimmune_disease' => [
            'noneTriggerValue' => 1,
            'fields' => [
                'comorbid_other_autoimmune_disease_UCTD' => false,
                'comorbid_other_autoimmune_disease_sjrogren_syndrome' => false,
                'comorbid_other_autoimmune_disease_MCTD' => false,
                'comorbid_other_autoimmune_disease_DMPM' => false,
                'comorbid_other_autoimmune_disease_other' => null
            ]
        ]
    ];

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
        if ( $value === null ) {
            $this->$field = null;
            $this->save();
            $this->header->touch();
            return $field;
        }

        if ( array_search($field, $this->selectItemFields) !== false ) {
            $item = app('db')->table('select_items')
                             ->select('value')
                             ->where(['field_name' => $field, 'label' => $value])
                             ->first();

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

        if ( array_key_exists($field, $this->fieldsWithExtras)
             && $value != $this->fieldsWithExtras[$field]['noneTriggerValue']
           ) {
            foreach ( $this->fieldsWithExtras[$field]['fields'] as $key => $value ) {
                $this->$key = $value;
            }
        }

        $this->save();
        $this->header->touch();
        return $field;
    }
}
