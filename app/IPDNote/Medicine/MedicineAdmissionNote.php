<?php

namespace App\IPDNote\Medicine;

use Illuminate\Database\Eloquent\Model;
use App\ModelHelper;

// use App\MockupPatient;
// use App\MockupWard;
use App\IPDNote\Note;

class MedicineAdmissionNote extends Model
{
	public $timestamps = false;

	protected $fillable = [];
    // protected $table = 'medicine_admission_note';
    // protected $checkBoxInputs = [
    //     'DM_DR',
    //     'DM_nephropathy',
    //     'DM_neuropathy',
    //     'DM_on_diet',
    //     'DM_on_oral_med',
    //     'DM_on_insulin',
    //     'VHD_dx_AS',
    //     'VHD_dx_AR',
    //     'VHD_dx_MS',
    //     'VHD_dx_MR',
    //     'VHD_dx_TR',
    //     'stroke_ischemic',
    //     'stroke_hemorrhagic',
    //     'stroke_iembolic',
    //     'cirrhosis_etiology_HBV',
    //     'cirrhosis_etiology_HCV',
    //     'cirrhosis_etiology_NASH',
    //     'cirrhosis_etiology_cryptogenic',
    //     'HIV_pre_infect_TB',
    //     'HIV_pre_infect_PCP',
    //     'HIV_pre_infect_candidiasis',
    //     'HIV_pre_infect_CMV',
    //     'cancer_at_lung',
    //     'cancer_at_liver',
    //     'cancer_at_colon',
    //     'cancer_at_breast',
    //     'cancer_at_prostate',
    //     'cancer_at_cervix',
    //     'cancer_at_pancreas',
    //     'cancer_at_brain',
    //     'chronic_arthritis_CPPD',
    //     'chronic_arthritis_rheumatoid',
    //     'chronic_arthritis_OA',
    //     'chronic_arthritis_spondyloarthropathy',
    //     'other_autoimmune_disease_dx_sjrogren_syndrome',
    //     'other_autoimmune_disease_dx_UCTD',
    //     'other_autoimmune_disease_dx_MCTD',
    //     'other_autoimmune_disease_dx_DMPM',
    //     'TB_at_pulmonary',
    //     'dementia_vascular',
    //     'dementia_alzheimer',
    //     'psychiatric_illness_dx_schizophrenia',
    //     'psychiatric_illness_dx_major_depression',
    //     'psychiatric_illness_dx_bipolar_disorder',
    //     'psychiatric_illness_dx_adjustment_disorder',
    //     'psychiatric_illness_dx_Obcessive_compulsive_disorder',
    // ];
    // protected $fillable =[
    // 		'HN',
				// // 'patient_name',
				// // 'gender',
				// // 'age',
				// 'AN',
				// 'date_admit',
    //     'ward_id',

    //     'attending_id',
    //     'reason_admit',
    //     'reason_admit_other',
        
    //     'chief_complaint',

    //     'comorbid_DM',
    //     'DM_type',
    //     'DM_DR',
    //     'DM_nephropathy',
    //     'DM_neuropathy',
    //     'DM_on_diet',
    //     'DM_on_oral_med',
    //     'DM_on_insulin',

    //     'comorbid_HT',

    //     'comorbid_CAD',
    //     'CAD_dx',
    //     'CAD_dx_other',
        
    //     'comorbid_VHD',
    //     'VHD_dx_AS',
    //     'VHD_dx_AR',
    //     'VHD_dx_MS',
    //     'VHD_dx_MR',
    //     'VHD_dx_TR',
    //     'VHD_dx_other',

    //     'comorbid_stroke',
    //     'stroke_ischemic',
    //     'stroke_ischemic_result',
    //     'stroke_ischemic_result_on',
    //     'stroke_hemorrhagic',
    //     'stroke_hemorrhagic_result',
    //     'stroke_hemorrhagic_result_on',
    //     'stroke_iembolic',
    //     'stroke_iembolic_result',
    //     'stroke_iembolic_result_on',

    //     'comorbid_COPD',
        
    //     'comorbid_asthma',
        
    //     'comorbid_CKD',
    //     'CKD_stage',
        
    //     'comorbid_hyperlipidemia',
    //     'hyperlipidemia_type',

    //     'comorbid_cirrhosis',
    //     'cirrhosis_cp_score',
    //     'cirrhosis_etiology_HBV',
    //     'cirrhosis_etiology_HCV',
    //     'cirrhosis_etiology_NASH',
    //     'cirrhosis_etiology_cryptogenic',
    //     'cirrhosis_etiology_other',

    //     'comorbid_coagulopathy',

    //     'comorbid_HBV',

    //     'comorbid_HCV',

    //     'comorbid_HIV',
    //     'HIV_pre_infect_TB',
    //     'HIV_pre_infect_PCP',
    //     'HIV_pre_infect_candidiasis',
    //     'HIV_pre_infect_CMV',
    //     'HIV_pre_infect_other',

    //     'comorbid_epilepsy',
    //     'epilepsy_dx',
    //     'epilepsy_dx_other',
        
    //     'comorbid_leukemia',
    //     'leukemia_dx',
        
    //     'comorbid_lymphoma',
    //     'lymphoma_dx',
    //     'lymphoma_dx_other',
        
    //     'comorbid_pacemaker_implant',
    //     'pacemaker_implant_type',
    //     'pacemaker_implant_type_other',
    //     'comorbid_ICD',
    //     'ICD_type',
        
    //     'comorbid_cancer',
    //     'cancer_at_lung',
    //     'cancer_at_liver',
    //     'cancer_at_colon',
    //     'cancer_at_breast',
    //     'cancer_at_prostate',
    //     'cancer_at_cervix',
    //     'cancer_at_pancreas',
    //     'cancer_at_brain',
    //     'cancer_at_other',

    //     'comorbid_chronic_arthritis',
    //     'chronic_arthritis_CPPD',
    //     'chronic_arthritis_rheumatoid',
    //     'chronic_arthritis_OA',
    //     'chronic_arthritis_spondyloarthropathy',
    //     'chronic_arthritis_other',
        
    //     'comorbid_SLE',
        
    //     'comorbid_other_autoimmune_disease',
    //     'other_autoimmune_disease_dx_sjrogren_syndrome',
    //     'other_autoimmune_disease_dx_UCTD',
    //     'other_autoimmune_disease_dx_MCTD',
    //     'other_autoimmune_disease_dx_DMPM',
    //     'other_autoimmune_disease_dx_other',
        
    //     'comorbid_TB',
    //     'TB_at_pulmonary',
    //     'TB_at_other',

    //     'comorbid_dementia',
    //     'dementia_vascular',
    //     'dementia_alzheimer',
    //     'dementia_other',
        
    //     'comorbid_psychiatric_illness',
    //     'psychiatric_illness_dx_schizophrenia',
    //     'psychiatric_illness_dx_major_depression',
    //     'psychiatric_illness_dx_bipolar_disorder',
    //     'psychiatric_illness_dx_adjustment_disorder',
    //     'psychiatric_illness_dx_Obcessive_compulsive_disorder',
    //     'psychiatric_illness_dx_other',
        
    //     'comorbid_other',

    //     'history_present_illness',
    //     'history_past_illness',

    //     'pregnant',
    //     'pregnant_weeks',
    //     'LMP',
    //     'alcohol',
    //     'alcohol_amount',
    //     'smoking',
    //     'smoking_amount',
    //     'personal_social_history',
    //     'special_requirement_ng_tube',
    //     'special_requirement_ng_suction',
    //     'special_requirement_gastrostomy',
    //     'special_requirement_urinary_cath',
    //     'special_requirement_tracheostomy',
    //     'special_requirement_hearing_impairment',
    //     'special_requirement_isolate_room',
    //     'special_requirement_other',
    //     'personal_family_history',
    //     'current_medications',
    //     'allergy',
    //     'general_symtoms',
    //     'hair_skin_review',
    //     'hair_skin_review_detail',
    //     'head_review',
    //     'head_review_detail',
    //     'eye_ent_review',
    //     'eye_ent_review_detail',
    //     'breast_review',
    //     'breast_review_detail',
    //     'cvs_review',
    //     'cvs_review_detail',
    //     'rs_review',
    //     'rs_review_detail',
    //     'gi_review',
    //     'gi_review_detail',
    //     'gu_review',
    //     'gu_review_detail',
    //     'musculoskeletal_review',
    //     'musculoskeletal_review_detail',
    //     'nervous_review',
    //     'nervous_review_detail',
    //     'psychological_review',
    //     'psychological_review_detail',
    //     'system_review_other',
    //     'temperature',
    //     'pulse',
    //     'respiratory_rate',
    //     'SBP',
    //     'DBP',
    //     'height',
    //     'estimated_height',
    //     'weight',
    //     'estimated_weight',
    //     'BMI',
    //     'spo2',
    //     'breathing',
    //     'breathing_on',
    //     'o2_rate',
    //     'conscious_level',
    //     'GCS_E',
    //     'GCS_V',
    //     'GCS_M',
    //     'GCS_tot',
    //     'mental_evaluate',
    //     'orientation_time',
    //     'orientation_place',
    //     'orientation_person',

    //     'general_appearance',
    //     'skin_exam',
    //     'skin_exam_detail',
    //     'head_exam',
    //     'head_exam_detail',
    //     'eyeENT_exam',
    //     'eyeENT_exam_detail',
    //     'neck_exam',
    //     'neck_exam_detail',
    //     'heart_exam',
    //     'heart_exam_detail',
    //     'lung_exam',
    //     'lung_exam_detail',
    //     'abdomen_exam',
    //     'abdomen_exam_detail',
    //     'nervous_exam',
    //     'nervous_exam_detail',
    //     'neuro_exam',
    //     'neuro_exam_detail',
    //     'extremities_exam',
    //     'extremities_exam_detail',
    //     'lymphNodes_exam',
    //     'lymphNodes_exam_detail',
    //     'breasts_exam',
    //     'breasts_exam_detail',
    //     'genitalia_exam',
    //     'genitalia_exam_detail',
    //     'rectal_exam',
    //     'rectal_exam_detail',
    //     'pertinent_investigation',

    //     'problem_list',
    //     'discussion',
    //     'provisional_dx',
    //     'plan_investigation',
    //     'plan_management',
    //     'special_group_CPG',
    //     'plan_consult',
    //     'estimated_los',

    //     // 'creator',
    //     // 'updater',
    // ];

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}

    // public function getCheckBoxInputs() {
        
    //     return $this->checkBoxInputs;
    // }

    // public function getPatientName() {
    //     $note = Note::find($this->attributes['note_id']);
    //     return $note->patient_name;
    // }

    // public function ageAtNote() {
    //     $patient = Patient::foundOrNew($this->attributes['HN']);
    //     // return $patient;
    //     if (isset($patient->dob)) {
    //         return Carbon::createFromFormat('d-m-Y', $patient->dob)->diffInYears($this->attribute['created_at']);
    //         // return $dob->diffInYears($dateNote);
    //     }
    //     return NULL;
    // }

    // public function mockUp()
    // {
    //     // patient
    //     $patient = MockupPatient::find(rand(1,22698));
    //     $this->attributes['HN'] = $patient->HN;

    //     $this->attributes['patient_name'] = $patient->name;
    //     $this->attributes['gender'] = $patient->gender;
        
    //     if ($patient->gender)
    //         session(['patient_gender' => 'ชาย']);
    //     else
    //         session(['patient_gender' => 'หญิง']);
        
    //     $this->attributes['age'] = \Carbon\Carbon::createFromFormat('Y-m-d',$patient->dob)->diffInYears(\Carbon\Carbon::now());
        
    //     // ward
    //     $ward = MockupWard::find(rand(1,141));
    //     session(['ward_name' => $ward->name]);
    //     $ward = MockupWard::where('name',session('ward_name'))->first();
    //     $this->attributes['date_admit'] = \Carbon\Carbon::now()->format('Y-m-d');
    //     $this->attributes['ward_id'] = $ward->id;
    // }

    private function checkComorbid($code, $diag) // Check that is there comorbid and return text.
    {
        return ($code == 1) ? $diag : ( ($code === 0) ? 'NO ' . $diag . ".\r\n" : '');
        // if ($code == 1)
        //     return $diag;
        // elseif ($code === 0) // ***************** null == 0 ************************
        //     return 'NO ' . $diag . ".\r\n";
        // else
        //     return '';
    }
    
    public function comorbidToString() // Generate comorbid for human readable form.
    {
        $txt = ''; // return $txt.

        // DM to string.
        $check = $this->attributes['comorbid_DM'];
        $txt .= $this->checkComorbid($check,'DM'); // DM check.
        if ($check == 1) {
            if (!is_null($this->attributes['DM_type'])) { // DM_type emty if no data.
                $txt .=  " type " . (($this->attributes['DM_type'] == 1) ? 'I' : 'II');
            } else {
                $txt .=  ".";
            }

            if (!$this->attributes['DM_DR'] && !$this->attributes['DM_nephropathy'] && !$this->attributes['DM_neuropathy']) { //DM no complication.
                $txt .= " NO compliaction";
            } else { // DM with complication
                $txt .= " with ";
                $first = true; // flag for first item.
                if ($this->attributes['DM_DR']) { // DM_DR.
                    $first = false;
                    $txt .= " DR";
                }
                if ($this->attributes['DM_nephropathy']) { // DM_nephropathy.
                    if ($first) {
                        $first = false;
                        $txt .= " nephropathy";
                    } else {
                        $txt .= ", nephropathy";
                    }
                }
                if ($this->attributes['DM_neuropathy']) { // DM_neuropathy.
                    if ($first) {
                        $first = false;
                        $txt .= " neuropathy";
                    } else {
                        $txt .= ", neuropathy";
                    }
                }
                $txt .= "; ";
            }
            // $txt .= ".";
            if (!$this->attributes['DM_on_diet'] && !$this->attributes['DM_on_oral_med'] && !$this->attributes['DM_on_insulin']) { //DM no treatment data.
                $txt .= " NO treatment data";
            } else { // DM with teatments.
                $txt .= " on ";
                $first = true; // flag for first item.
                if ($this->attributes['DM_on_diet']) { // DM_on_diet.
                    $first = false;
                    $txt .= " diet";
                }
                if ($this->attributes['DM_on_oral_med']) { // DM_on_oral_med.
                    if ($first) {
                        $first = false;
                        $txt .= " oral medications";
                    } else {
                        $txt .= ", oral medications";
                    }
                }
                if ($this->attributes['DM_on_insulin']) { // DM_on_insulin.
                    if ($first) {
                        $first = false;
                        $txt .= " insulin";
                    } else {
                        $txt .= ", insulin";
                    }
                }
            }
            $txt .= "\r\n"; // END DM sentence.
        }

        // HT to string.
        $check = $this->attributes['comorbid_HT'];
        $txt .= $this->checkComorbid($check,'HT'); // HT check.
        if ($check == 1) $txt .= "\r\n"; // END HT sentence.

        // CAD to string.
        $check = $this->attributes['comorbid_CAD'];
        $txt .= $this->checkComorbid($check,'CAD'); // CAD check.
        if ($check == 1) {
            if (is_null($this->attributes['CAD_dx'])) { // return . and newline if null.
                $txt .= ".\r\n";
            } else {
                if ($this->attributes['CAD_dx'] == 1) 
                    $txt .= ". Diagnosis : Old MI.\r\n";
                elseif ($this->attributes['CAD_dx'] == 2)
                    $txt .= ". Diagnosis : Unstable angina.\r\n";
                elseif ($this->attributes['CAD_dx'] == 3)
                    $txt .= ". Diagnosis : Stable angina.\r\n";
                else {// in case of other Dx.
                    if ($this->attributes['CAD_dx_other'] == "")
                        $txt .= ". Diagnosis : unknown.\r\n";
                    else 
                        $txt .= ". Diagnosis : " . $this->attributes['CAD_dx_other'] . ".\r\n";
                }
            }
        }
        
        // VHD to string.
        $check = $this->attributes['comorbid_VHD'];
        $txt .= $this->checkComorbid($check,'VHD'); // VHD check.
        if ($check == 1) {
            $dx = false;
            $first = true; // flag for first item.
            if ($this->attributes['VHD_dx_AS']) { // VHD_dx_AS.
                $dx = true;
                $first = false;
                $txt .= " AS";
            }
            if ($this->attributes['VHD_dx_AR']) { // VHD_dx_AR.
                if ($first) {
                    $dx = true;
                    $first = false;
                    $txt .= " AR";
                } else {
                    $txt .= ", AR";
                }
            }
            if ($this->attributes['VHD_dx_MS']) { // VHD_dx_MS.
                if ($first) {
                    $dx = true;
                    $first = false;
                    $txt .= " MS";
                } else {
                    $txt .= ", MS";
                }
            }
            if ($this->attributes['VHD_dx_MR']) { // VHD_dx_MR.
                if ($first) {
                    $dx = true;
                    $first = false;
                    $txt .= " MR";
                } else {
                    $txt .= ", MR";
                }
            }
            if ($this->attributes['VHD_dx_TR']) { // VHD_dx_TR.
                if ($first) {
                    $dx = true;
                    $first = false;
                    $txt .= " TR";
                } else {
                    $txt .= ", TR";
                }
            }
            if ($this->attributes['VHD_dx_other'] == '')  // VHD_dx_other.
                $txt .= ".\r\n";
            elseif ($first) {
                $txt .= " " . $this->attributes['VHD_dx_other'] . "\r\n";
                $dx = true;
            }
            else
                $txt .= ", " . $this->attributes['VHD_dx_other'] . "\r\n";

            if ($dx)
                $txt = str_replace('VHD', '', $txt);
            else
                $txt = str_replace('VHD', 'Valvular heart disease', $txt);
        }

        // Stroke to string.
        $check = $this->attributes['comorbid_stroke'];
        $txt .= $this->checkComorbid($check,'Stroke'); // stroke check.
        if ($check == 1) {
            $txt .= ".";
            if ($this->attributes['stroke_ischemic']) {
                $txt .= " Ischemic";
                if ($this->attributes['stroke_ischemic_result_on'] == 1) //left
                    $txt .= " left";
                elseif ($this->attributes['stroke_ischemic_result_on'] == 2)
                    $txt .= " right";
                if ($this->attributes['stroke_ischemic_result'] == 1)
                    $txt .= " hemiparesis.";
                elseif ($this->attributes['stroke_ischemic_result'] == 2)
                    $txt .= " hemiplegia.";
                else
                    $txt .= ".";
            }

            if ($this->attributes['stroke_hemorrhagic']) {
                $txt .= " Hemorrhagic";
                if ($this->attributes['stroke_hemorrhagic_result_on'] == 1) // left.
                    $txt .= " left";
                elseif ($this->attributes['stroke_hemorrhagic_result_on'] == 2) // right.
                    $txt .= " right";
                if ($this->attributes['stroke_hemorrhagic_result'] == 1) // hemiparesis.
                    $txt .= " hemiparesis.";
                elseif ($this->attributes['stroke_hemorrhagic_result'] == 2) // hemiplegia.
                    $txt .= " hemiplegia.";
                else
                    $txt .= ".";
            }

            if ($this->attributes['stroke_iembolic']) {
                $txt .= " Iembolic";
                if ($this->attributes['stroke_iembolic_result_on'] == 1) // left.
                    $txt .= " left";
                elseif ($this->attributes['stroke_iembolic_result_on'] == 2) // right.
                    $txt .= " right";
                if ($this->attributes['stroke_iembolic_result'] == 1) // hemiparesis.
                    $txt .= " hemiparesis.";
                elseif ($this->attributes['stroke_iembolic_result'] == 2) //hemiplegia.
                    $txt .= " hemiplegia.";
                else
                    $txt .= ".";
            }
            
            $txt .= "\r\n";
        }

        // COPD to string.
        $check = $this->attributes['comorbid_COPD'];
        $txt .= $this->checkComorbid($check,'COPD'); // COPD check.
        if ($check == 1) $txt .= ".\r\n";

        // asthma to string.
        $check = $this->attributes['comorbid_asthma'];
        $txt .= $this->checkComorbid($check,'Asthma'); // asthma check.
        if ($check == 1) $txt .= ".\r\n";

        // CKD to string.
        $check = $this->attributes['comorbid_CKD'];
        $txt .= $this->checkComorbid($check,'CKD'); // CKD check.
        if ($check ==1)
            if ($this->attributes['CKD_stage'] == 1)
                $txt .= " stage I.\r\n";
            elseif ($this->attributes['CKD_stage'] == 2)
                $txt .= " stage II.\r\n";
            elseif ($this->attributes['CKD_stage'] == 3)
                $txt .= " stage III.\r\n";
            elseif ($this->attributes['CKD_stage'] == 4)
                $txt .= " stage IV.\r\n";
            elseif ($this->attributes['CKD_stage'] == 50)
                $txt .= " stage V, no dialysis.\r\n";
            elseif ($this->attributes['CKD_stage'] == 51)
                $txt .= " stage V, on HD.\r\n";
            elseif ($this->attributes['CKD_stage'] == 52)
                $txt .= " stage V, on PD.\r\n";
            else
                $txt .= " stage unknown.\r\n";

        // hyperlipidemia to string.
        $check = $this->attributes['comorbid_hyperlipidemia'];
        $txt .= $this->checkComorbid($check,'Hyperlipidemia'); // hyperlipidemia check.
        if ($check == 1) 
            if ($this->attributes['hyperlipidemia_type'] == 1)
                $txt .= ". Hypercholesterolemia.\r\n";
            elseif ($this->attributes['hyperlipidemia_type'] == 2)
                $txt .= ". Hypertriglyceridemia.\r\n";
            elseif ($this->attributes['hyperlipidemia_type'] == 1)
                $txt .= ". Mixed-hyperlipidemia.\r\n";
            else
                $txt .= ".\r\n";
        
        // cirrhosis to string.
        $check = $this->attributes['comorbid_cirrhosis'];
        $txt .= $this->checkComorbid($check,'Cirrhosis'); // cirrhosis check.
        if ($check == 1) {
            if ($this->attributes['cirrhosis_cp_score'] == 1)
                $txt .= ". Child-Pugh score = A";
            elseif ($this->attributes['cirrhosis_cp_score'] == 2)
                $txt .= ". Child-Pugh score = B";
            elseif ($this->attributes['cirrhosis_cp_score'] == 3)
                $txt .= ". Child-Pugh score = C";
            // else
            //     $txt .= ".";

            if ($this->attributes['cirrhosis_etiology_cryptogenic'])
                $txt .= ". Etiology : Cryptogenic.\r\n";
            else {
                $first = true;
                if ($this->attributes['cirrhosis_etiology_HBV']) {
                    $first = false;
                    $txt .= ". Etiology : HBV";
                }
                if ($this->attributes['cirrhosis_etiology_HCV']) {
                    if ($first) {
                        $first = false;
                        $txt .= ". Etiology : HCV";
                    } else {
                        $txt .= ", HCV";
                    }
                }
                if ($this->attributes['cirrhosis_etiology_NASH']) {
                    if ($first) {
                        $first = false;
                        $txt .= ". Etiology : NASH";
                    } else {
                        $txt .= ", NASH";
                    }
                }
                if ($this->attributes['cirrhosis_etiology_other'] == '')
                    $txt .= ".\r\n";
                elseif ($first)
                    $txt .= ". Etiology : " . $this->attributes['cirrhosis_etiology_other'] . ".\r\n";
                else
                    $txt .= ", " . $this->attributes['cirrhosis_etiology_other'] . ".\r\n";
            }
        }

        // coagulopathy to string.
        $check = $this->attributes['comorbid_coagulopathy'];
        $txt .= $this->checkComorbid($check,'Coagulopathy'); // coagulopathy check.
        if ($check == 1) $txt .= ".\r\n";
        
        // HBV to string.
        $check = $this->attributes['comorbid_HBV'];
        $txt .= $this->checkComorbid($check,'HBV'); // HBV check.
        if ($check == 1) $txt .= ".\r\n";

        // HCV to string.
        $check = $this->attributes['comorbid_HCV'];
        $txt .= $this->checkComorbid($check,'HCV'); // HCV check.
        if ($check == 1) $txt .= ".\r\n";

        // HIV to string.
        $check = $this->attributes['comorbid_HIV'];
        $txt .= $this->checkComorbid($check,'HIV infection'); // HIV check.
        if ($check == 2) // HIV infection.
            $txt .= ".\r\n";
        elseif ($check == 1) { // AIDS.
            $txt = str_replace('HIV infection', 'AIDS', $txt);
            $first = true;
            if ($this->attributes['HIV_pre_infect_TB']) {
                $first = false;
                $txt .= ". Previous opportunistic infection : TB";
            }
            if ($this->attributes['HIV_pre_infect_PCP']) {
                if ($first) {
                    $first = false;
                    $txt .= ". Previous opportunistic infection : PCP";
                } else {
                    $txt .= ", PCP";
                }
            }
            if ($this->attributes['HIV_pre_infect_candidiasis']) {
                if ($first) {
                    $first = false;
                    $txt .= ". Previous opportunistic infection : candidiasis";
                } else {
                    $txt .= ", candidiasis";
                }
            }
            if ($this->attributes['HIV_pre_infect_CMV']) {
                if ($first) {
                    $first = false;
                    $txt .= ". Previous opportunistic infection : CMV";
                } else {
                    $txt .= ", CMV";
                }
            }
            if ($this->attributes['HIV_pre_infect_other'] == '')
                $txt .= ".\r\n";
            else
                $txt .= ", " . $this->attributes['HIV_pre_infect_other'] . ".";
        }

        // epilepsy to string.
        $check = $this->attributes['comorbid_epilepsy'];
        $txt .= $this->checkComorbid($check,'Epilepsy'); // epilepsy check.
        if ($check == 1) 
            if ($this->attributes['epilepsy_dx'] == 0)
                $txt .= $this->attributes['epilepsy_dx_other'] == '' ? ".\r\n" : ". Diagnosis : " . $this->attributes['epilepsy_dx_other'] . ".\r\n";
            elseif ($this->attributes['epilepsy_dx'] == 1)
                $txt .= ". Diagnosis : GTC.\r\n";
            elseif ($this->attributes['epilepsy_dx'] == 2)
                $txt .= ". Diagnosis : Focal.\r\n";
            elseif ($this->attributes['epilepsy_dx'] == 3)
                $txt .= ". Diagnosis : Complex partial seizure.\r\n";
            elseif ($this->attributes['epilepsy_dx'] == 4)
                $txt .= ". Diagnosis : Unknown.\r\n";
            else
                $txt .= ".\r\n";
        
        // leukemia to string.
        $check = $this->attributes['comorbid_leukemia'];
        $txt .= $this->checkComorbid($check,'Leukemia'); // leukemia check.
        if ($check == 1)
            if ($this->attributes['leukemia_dx'] == 1)
                $txt .= ". Diagnosis : ALL.\r\n";
            elseif ($this->attributes['leukemia_dx'] == 2)
                $txt .= ". Diagnosis : AML.\r\n";
            elseif ($this->attributes['leukemia_dx'] == 3)
                $txt .= ". Diagnosis : CLL.\r\n";
            elseif ($this->attributes['leukemia_dx'] == 4)
                $txt .= ". Diagnosis : CML.\r\n";
            else
                $txt .= ".\r\n";

        // lymphoma to string.
        $check = $this->attributes['comorbid_lymphoma'];
        $txt .= $this->checkComorbid($check,'Lymphoma'); // lymphoma check.
        if ($check == 1)
            if ($this->attributes['lymphoma_dx'] == 0)
                $txt .= ($this->attributes['lymphoma_dx_other'] == '') ? ".\r\n" : ". Disgnosis : " . $this->attributes['lymphoma_dx_other'] . ".\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 1)
                $txt .= ". Diagnosis : Hodgkin.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 2)
                $txt .= ". Diagnosis : Non-Hodgkin - Diffuse large B cell.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 3)
                $txt .= ". Diagnosis : Non-Hodgkin - Diffuse large T cell.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 4)
                $txt .= ". Diagnosis : Non-Hodgkin - Follicular B cell.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 5)
                $txt .= ". Diagnosis : Non-Hodgkin - Follicular T cell.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 6)
                $txt .= ". Diagnosis : Non-Hodgkin - Burkitt High grade.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 7)
                $txt .= ". Diagnosis : Non-Hodgkin - Burkitt Low grade.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 8)
                $txt .= ". Diagnosis : Non-Hodgkin - Other High grade.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 9)
                $txt .= ". Diagnosis : Non-Hodgkin - Other Low grade.\r\n";
            elseif ($this->attributes['lymphoma_dx'] == 10)
                $txt .= ". Diagnosis : Intravascular.\r\n";
            else
                $txt .= ".\r\n";

        // pacemaker_implant to string.
        $check = $this->attributes['comorbid_pacemaker_implant'];
        $txt .= $this->checkComorbid($check,'Pacemaker implanted'); // pacemaker_implant check.
        if ($check == 1)
            if ($this->attributes['pacemaker_implant_type'] == 0)
                $txt .= ($this->attributes['pacemaker_implant_type_other'] == '') ? ".\r\n" : ". Type : " . $this->attributes['pacemaker_implant_type_other'] . ".\r\n";
            elseif ($this->attributes['pacemaker_implant_type'] == 1)
                $txt .= ". Type : DDDR (dual-chamber, rate-modulated).\r\n";
            elseif ($this->attributes['pacemaker_implant_type'] == 2)
                $txt .= ". Type : VVI.\r\n";
            else
                $txt .= ".\r\n";
        
        // ICD to string.
        $check = $this->attributes['comorbid_ICD'];
        $txt .= $this->checkComorbid($check,'ICD'); // ICD check.
        if ($check == 1)
            $txt .= ($this->attributes['ICD_type'] == '') ? ".\r\n" : ". Type : " . $this->attributes['ICD_type'] . ".\r\n";
        
        // Cancer to string.
        $check = $this->attributes['comorbid_cancer'];
        $txt .= $this->checkComorbid($check,'Cancer'); // cancer check.
        if ($check == 1) {
            $first = true; // flag for first item.
            if ($this->attributes['cancer_at_lung']) { // cancer_at_lung.
                $first = false;
                $txt .= ". At : lung";
            }
            if ($this->attributes['cancer_at_liver']) { // cancer_at_liver.
                if ($first) {
                    $first = false;
                    $txt .= ". At : liver";
                } else {
                    $txt .= ", liver";
                }
            }
            if ($this->attributes['cancer_at_colon']) { // cancer_at_colon.
                if ($first) {
                    $first = false;
                    $txt .= ". At : colon";
                } else {
                    $txt .= ", colon";
                }
            }
            if ($this->attributes['cancer_at_breast']) { // cancer_at_breast.
                if ($first) {
                    $first = false;
                    $txt .= ". At : breast";
                } else {
                    $txt .= ", breast";
                }
            }
            if ($this->attributes['cancer_at_prostate']) { // cancer_at_prostate.
                if ($first) {
                    $first = false;
                    $txt .= ". At : prostate";
                } else {
                    $txt .= ", prostate";
                }
            }
            if ($this->attributes['cancer_at_cervix']) { // cancer_at_cervix.
                if ($first) {
                    $first = false;
                    $txt .= ". At : cervix";
                } else {
                    $txt .= ", cervix";
                }
            }
            if ($this->attributes['cancer_at_pancreas']) { // cancer_at_pancreas.
                if ($first) {
                    $first = false;
                    $txt .= ". At : pancreas";
                } else {
                    $txt .= ", pancreas";
                }
            }
            if ($this->attributes['cancer_at_brain']) { // cancer_at_brain.
                if ($first) {
                    $first = false;
                    $txt .= ". At : brain";
                } else {
                    $txt .= ", brain";
                }
            }
            if ($this->attributes['cancer_at_other'] == '')  // cancer_at_other.
                $txt .= ".\r\n";
            elseif ($first)
                $txt .= ". At : " . $this->attributes['cancer_at_other'] . ".\r\n";
            else
                $txt .= ", " . $this->attributes['cancer_at_other'] . ".\r\n";
        }

        // chronic_arthritis to string.
        $check = $this->attributes['comorbid_chronic_arthritis'];
        $txt .= $this->checkComorbid($check,'Chronic arthritis'); // chronic_arthritis check.
        if ($check == 1) {
            $first = true; // flag for first item.
            if ($this->attributes['chronic_arthritis_CPPD']) { // chronic_arthritis_CPPD.
                $first = false;
                $txt .= ". At : CPPD";
            }
            if ($this->attributes['chronic_arthritis_rheumatoid']) { // chronic_arthritis_rheumatoid.
                if ($first) {
                    $first = false;
                    $txt .= ". At : rheumatoid";
                } else {
                    $txt .= ", rheumatoid";
                }
            }
            if ($this->attributes['chronic_arthritis_OA']) { // chronic_arthritis_OA.
                if ($first) {
                    $first = false;
                    $txt .= ". At : OA";
                } else {
                    $txt .= ", OA";
                }
            }
            if ($this->attributes['chronic_arthritis_spondyloarthropathy']) { // chronic_arthritis_spondyloarthropathy.
                if ($first) {
                    $first = false;
                    $txt .= ". At : spondyloarthropathy";
                } else {
                    $txt .= ", spondyloarthropathy";
                }
            }
            if ($this->attributes['chronic_arthritis_other'] == '')  // chronic_arthritis_other.
                $txt .= ".\r\n";
            elseif ($first)
                $txt .= ". At : " . $this->attributes['chronic_arthritis_other'] . ".\r\n";
            else 
                $txt .= ", " . $this->attributes['chronic_arthritis_other'] . ".\r\n";
        }

        // SLE to string.
        $check = $this->attributes['comorbid_SLE'];
        $txt .= $this->checkComorbid($check,'SLE'); // SLE check.
        if ($check == 1) $txt .= ".\r\n";
        
        // other_autoimmune_disease to string.
        $check = $this->attributes['comorbid_other_autoimmune_disease'];
        $txt .= $this->checkComorbid($check,'Other autoimmune disease'); // other_autoimmune_disease check.
        if ($check == 1) {
            $first = true; // flag for first item.
            if ($this->attributes['other_autoimmune_disease_dx_sjrogren_syndrome']) { // other_autoimmune_disease_dx_sjrogren_syndrome.
                $first = false;
                $txt .= ". Diagnosis : Sjrögren syndrome";
            }
            if ($this->attributes['other_autoimmune_disease_dx_UCTD']) { // other_autoimmune_disease_dx_UCTD.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : UCTD";
                } else {
                    $txt .= ", UCTD";
                }
            }
            if ($this->attributes['other_autoimmune_disease_dx_MCTD']) { // other_autoimmune_disease_dx_MCTD.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : MCTD";
                } else {
                    $txt .= ", MCTD";
                }
            }
            if ($this->attributes['other_autoimmune_disease_dx_DMPM']) { // other_autoimmune_disease_dx_DMPM.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : DMPD";
                } else {
                    $txt .= ", DMPD";
                }
            }
            if ($this->attributes['other_autoimmune_disease_dx_other'] == '')  // other_autoimmune_disease_dx_other.
                $txt .= ".\r\n";
            elseif ($first)
                $txt .= ". Diagnosis : " . $this->attributes['other_autoimmune_disease_dx_other'] . ".\r\n";
            else
                $txt .= ", " . $this->attributes['other_autoimmune_disease_dx_other'] . ".\r\n";
        }
        
        // TB to string.
        $check = $this->attributes['comorbid_TB'];
        $txt .= $this->checkComorbid($check,'TB'); // TB check.
        if ($check == 1) {
            $first = true; // flag for first item.
            if ($this->attributes['TB_at_pulmonary']) { // TB_at_pulmonary.
                $first = false;
                $txt .= ". At : pulmonary";
            }
            if ($this->attributes['TB_at_other'] == '')  // TB_at_other.
                $txt .= ".\r\n";
            elseif ($first)
                $txt .= ". At : " . $this->attributes['TB_at_other'] . ".\r\n";
            else
                $txt .= ", " . $this->attributes['TB_at_other'] . ".\r\n";
        }
        
        // dementia to string.
        $check = $this->attributes['comorbid_dementia'];
        $txt .= $this->checkComorbid($check,'Dementia'); // dementia check.
        if ($check == 1) {
            $first = true; // flag for first item.
            if ($this->attributes['dementia_vascular']) { // dementia_vascular.
                $first = false;
                $txt .= ". Diagnosis : Vascilar";
            }
            if ($this->attributes['dementia_alzheimer']) { // dementia_alzheimer.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : Alzheimer";
                } else {
                    $txt .= ", Alzheimer";
                }
            }
            if ($this->attributes['dementia_other'] == '')  // dementia_other.
                $txt .= ".\r\n";
            elseif ($first)
                $txt .= ". Diagnosis : " . $this->attributes['dementia_other'] . ".\r\n";
            else
                $txt .= ", " . $this->attributes['dementia_other'] . ".\r\n";
        }

        // psychiatric_illness to string.
        $check = $this->attributes['comorbid_psychiatric_illness'];
        $txt .= $this->checkComorbid($check,'Psychiatric illness'); // psychiatric_illness check.
        if ($check == 1) {
            $first = true; // flag for first item.
            if ($this->attributes['psychiatric_illness_dx_schizophrenia']) { // psychiatric_illness_dx_schizophrenia.
                $first = false;
                $txt .= ". Diagnosis : schizophrenia";
            }
            if ($this->attributes['psychiatric_illness_dx_major_depression']) { // psychiatric_illness_dx_major_depression.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : major depression";
                } else {
                    $txt .= ", major depression";
                }
            }
            if ($this->attributes['psychiatric_illness_dx_bipolar_disorder']) { // psychiatric_illness_dx_bipolar_disorder.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : bipolar disorder";
                } else {
                    $txt .= ", bipolar disorder";
                }
            }
            if ($this->attributes['psychiatric_illness_dx_Obcessive_compulsive_disorder']) { // psychiatric_illness_dx_Obcessive_compulsive_disorder.
                if ($first) {
                    $first = false;
                    $txt .= ". Diagnosis : Obcessive compulsive disorder";
                } else {
                    $txt .= ", Obcessive compulsive disorder";
                }
            }
            if ($this->attributes['psychiatric_illness_dx_other'] == '')  // psychiatric_illness_dx_other.
                $txt .= ".\r\n";
            elseif ($first)
                $txt .= ". Diagnosis : " . $this->attributes['psychiatric_illness_dx_other'] . ".\r\n";
            else
                $txt .= ", " . $this->attributes['psychiatric_illness_dx_other'] . ".\r\n";
        }
        
        return $txt .= ($this->attributes['comorbid_other'] != '') ? $this->attributes['comorbid_other'] . '.' : '';
            // return $txt . $this->attributes['comorbid_other'] . '.';
        // else
        //     return $txt . 
    }

    public function reasonAdmitToString() // Transform reason admit to readable text.
    {
        if ($this->attributes['reason_admit'] == 0)
            return $this->attributes['reason_admit_other'];
        elseif ($this->attributes['reason_admit'] == 1)
            return 'Curative';
        elseif ($this->attributes['reason_admit'] == 2)
            return 'Curative+Palliative';
        elseif ($this->attributes['reason_admit'] == 3)
            return 'Palliative only';
        elseif ($this->attributes['reason_admit'] == 4)
            return 'Investigation';
        elseif ($this->attributes['reason_admit'] == 5)
            return 'Rehabilitation';
        else
            return '';
    }

    public function getSignificantFinding() // Combind all Physical exam fields.
    {
        $txt = '';
        $txt .= ($this->attributes['history_present_illness'] != '') ? "History of present illness : \r\n" . $this->attributes['history_present_illness'] . "\r\n\r\n" : '';
        $txt .= "Physical exam : \r\n\r\n";
        $txt .= ($this->attributes['general_appearance'] != '') ? 'General appearance : ' . $this->attributes['general_appearance'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['skin_exam_detail'] != '') ? 'Skin : ' . $this->attributes['skin_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['head_exam_detail'] != '') ? 'Head : ' . $this->attributes['head_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['eyeENT_exam_detail'] != '') ? 'Eye/ENT : ' . $this->attributes['eyeENT_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['neck_exam_detail'] != '') ? 'Neck : ' . $this->attributes['neck_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['heart_exam_detail'] != '') ? 'Heart : ' . $this->attributes['heart_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['lung_exam_detail'] != '') ? 'Lung : ' . $this->attributes['lung_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['abdomen_exam_detail'] != '') ? 'Abdomen : ' . $this->attributes['abdomen_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['nervous_exam_detail'] != '') ? 'Nervous : ' . $this->attributes['nervous_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['neuro_exam_detail'] != '') ? 'Neuro : ' . $this->attributes['neuro_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['extremities_exam_detail'] != '') ? 'Extremities : ' . $this->attributes['extremities_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['lymphNodes_exam_detail'] != '') ? 'LymphNodes : ' . $this->attributes['lymphNodes_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['breasts_exam_detail'] != '') ? 'Breasts : ' . $this->attributes['breasts_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['genitalia_exam_detail'] != '') ? 'Genitalia : ' . $this->attributes['genitalia_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['rectal_exam_detail'] != '') ? 'Rectal : ' . $this->attributes['rectal_exam_detail'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['pertinent_investigation'] != '') ? 'Pertinent investigation : ' . $this->attributes['pertinent_investigation'] . "\r\n\r\n" : '';
        return $txt;
    }

    public function getHospitalCourse()
    {
        $txt = '';
        $txt .= ($this->attributes['provisional_dx'] != '') ? "Provisional diagnosis : " . $this->attributes['provisional_dx'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['plan_investigation'] != '') ? "Plan of investigation : " . $this->attributes['plan_investigation'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['plan_management'] != '') ? "Plan of management : " . $this->attributes['plan_management'] . "\r\n\r\n" : '';
        $txt .= ($this->attributes['plan_consult'] != '') ? "Plan of consultation : " . $this->attributes['plan_consult'] . "\r\n\r\n" : '';
        return $txt;
    }

    /**
    * Encypt data before save to database.
    * @param string $field, strin $value.
    * @return void
    **/
    // protected function setEncryptData($field, $value) {
    //     $this->attributes[$field] = ($value == '') ? NUll : \Crypt::encrypt($value);
    // }

    /**
    * Decypt data before output by model.
    * @param string $field.
    * @return void
    **/
    // protected function getEncryptData($field) {
    //     return is_null($this->attributes[$field]) ? NULL : \Crypt::decrypt($this->attributes[$field]);
    // }

    // public function setANAttribute($value) { $this->setEncryptData('AN', $value); }
    // public function getANAttribute() { return $this->getEncryptData('AN'); }

    // public function setHNAttribute($value) { $this->setEncryptData('HN', $value); }
    // public function getHNAttribute() { return $this->getEncryptData('HN'); }

    // getter setter date_admit.
    // public function setDateAdmitAttribute($value)
    // {
    //     if ($value == '')
    //         $this->attributes['date_admit'] = null;
    //     else
    //         $this->attributes['date_admit'] = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $value);
    // }
    // public function getDateAdmitAttribute()
    // {
    //     if (is_null($this->attributes['date_admit']))
    //         return null;
    //     else
    //         return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date_admit'])->format('d-m-Y H:i:s');
    // }

    // // getter setter age.
    // public function setAgeAttribute($value)
    // {
    //     if (!is_numeric($value))
    //     	$this->attributes['age'] = null;
    //     else
    //     	$this->attributes['age'] = $value;
    // }

    // getter setter attending_id.
    // public function setAttendingIdAttribute($value)
    // {
    //     if (!is_numeric($value))
    //         $this->attributes['attending_id'] = null;
    //     else
    //         $this->attributes['attending_id'] = $value;
    // }

    // getter setter ward_id.
    // public function setWardIdAttribute($value)
    // {
    //     if (!is_numeric($value))
    //         $this->attributes['ward_id'] = null;
    //     else
    //         $this->attributes['ward_id'] = $value;
    // }

    public function lastSeenAppointmentData()
    {
        return 'lastSeenAppointmentData';
    }

    public function lastSeenPlacentaData()
    {
        return 'lastSeenPlacentaData';
    }
}
