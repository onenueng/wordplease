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
        'comorbid_lymphoma_specific',
        'comorbid_CAD_specific',
        'comorbid_hyperlipidemia_specific',
        'comorbid_epilepsy_specific',
        'GCS_E',
        'GCS_V',
        'GCS_M',
    ];

    protected $fieldsWithExtras = [
        'comorbid_DM' => [
            'resetTriggerValues' => [0,255],
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
            'resetTriggerValues' => [0,255],
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
            'resetTriggerValues' => [0,255],
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
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_lukemia_specific' => null
            ]
        ],

        'comorbid_ICD' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_ICD_other' => null
            ]
        ],

        'comorbid_dementia' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_dementia_other' => null,
                'comorbid_dementia_vascular' => false,
                'comorbid_dementia_alzheimer' => false
            ]
        ],

        'comorbid_stroke' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_stroke_ischemic' => null,
                'comorbid_stroke_hemorrhagic' => null,
                'comorbid_stroke_iembolic' => null
            ]
        ],

        'comorbid_CKD' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_CKD_stage' => null
            ]
        ],

        'comorbid_HIV' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_HIV_TB' => false,
                'comorbid_HIV_PCP' => false,
                'comorbid_HIV_candidiasis' => false,
                'comorbid_HIV_CMV' => false,
                'comorbid_HIV_other' => null
            ]
        ],

        'comorbid_lymphoma' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_lymphoma_specific' => null
            ]
        ],

        'comorbid_cancer' => [
            'resetTriggerValues' => [0,255],
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
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_other_autoimmune_disease_UCTD' => false,
                'comorbid_other_autoimmune_disease_sjrogren_syndrome' => false,
                'comorbid_other_autoimmune_disease_MCTD' => false,
                'comorbid_other_autoimmune_disease_DMPM' => false,
                'comorbid_other_autoimmune_disease_other' => null
            ]
        ],

        'comorbid_psychiatric_illness' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_psychiatric_illness_schizophrenia' => false,
                'comorbid_psychiatric_illness_major_depression' => false,
                'comorbid_psychiatric_illness_bipolar_disorder' => false,
                'comorbid_psychiatric_illness_adjustment_disorder' => false,
                'comorbid_psychiatric_illness_obcessive_compulsive_disorder' => false,
                'comorbid_psychiatric_illness_other' => null
            ]
        ],

        'comorbid_epilepsy' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_epilepsy_specific' => null
            ]
        ],

        'comorbid_pacemaker_implant' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_pacemaker_implant_specific' => null
            ]
        ],

        'comorbid_chronic_arthritis' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_chronic_arthritis_CPPD' => false,
                'comorbid_chronic_arthritis_rheumatoid' => false,
                'comorbid_chronic_arthritis_OA' => false,
                'comorbid_chronic_arthritis_spondyloarthropathy' => false,
                'comorbid_chronic_arthritis_other' => null,
            ]
        ],

        'comorbid_TB' => [
            'resetTriggerValues' => [0,255],
            'fields' => [
                'comorbid_TB_pulmonary' => false,
                'comorbid_TB_other' => null,
            ]
        ],

        'pregnancy' => [
            'resetTriggerValues' => [0,2],
            'fields' => [
                'gestation_weeks' => null,
            ]
        ],

        'alcohol' => [
            'resetTriggerValues' => [0],
            'fields' => [
                'alcohol_description' => null,
            ]
        ],

        'cigarette_smoking' => [
            'resetTriggerValues' => [0],
            'fields' => [
                'smoke_description' => null,
            ]
        ],

        'breathing' => [
            'resetTriggerValues' => [1],
            'fields' => [
                'O2_rate' => null,
            ]
        ],
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
        if ( array_search($field, $this->selectItemFields) !== false && $value !== null ) {
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
        if ( array_key_exists($field, $this->fieldsWithExtras)
             && in_array($value, $this->fieldsWithExtras[$field]['resetTriggerValues'])
             // $value != $this->fieldsWithExtras[$field]['noneTriggerValue']
           ) {
            foreach ( $this->fieldsWithExtras[$field]['fields'] as $key => $value ) {
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

        return $item->value;
    }
}
