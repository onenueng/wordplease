<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Traits\DataCryptable;
use App\Models\Lists\Patient;
use App\Models\Lists\Insurance;
use App\Traits\AutoIdInsertable;
use App\Traits\DatetimeHandleable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lists\AdmissionDiagnosis;

class Admission extends Model implements AutoId
{
    use AutoIdInsertable, DataCryptable, DatetimeHandleable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'an',
        'patient_id',
        'insurance_id',
        'patient_name',
        'datetime_admit',
        'datetime_discharge'
    ];

    protected $dates = [
        'datetime_admit',
        'datetime_discharge'
    ];

    /**
     * Set field 'an'.
     *
     * @param string $value
     */
    public function setAnAttribute($value)
    {
        $this->attributes['an'] = $this->encryptField($value);
        $this->attributes['mini_hash'] = $this->miniHash($value);
    }

    /**
     * Get field 'an'.
     *
     * @return string
     */
    public function getAnAttribute()
    {
        return $this->decryptField($this->attributes['an']);
    }

    /**
     * Set field 'patient_name'.
     *
     * @param string $value
     */
    public function setPatientNameAttribute($value)
    {
        $this->attributes['patient_name'] = $this->encryptField($value);
    }

    /**
     * Get field 'patient_name'.
     *
     * @return string
     */
    public function getPatientNameAttribute()
    {
        return $this->decryptField($this->attributes['patient_name']);
    }

    /**
     * Set field 'datetime_admit'.
     *
     * @param string $value
     */
    public function setDatetimeAdmitAttribute($value)
    {
        $this->attributes['datetime_admit'] = $this->handleDatetime($value);
    }

    /**
     * Set field 'datetime_discharge'.
     *
     * @param string $value
     */
    public function setDatetimeDischargeAttribute($value)
    {
        $this->attributes['datetime_discharge'] = $this->handleDatetime($value);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    // public static function findByAn($an)
    // {
    //     $admissions = static::select('id', 'an')->where('mini_hash', (new static)->miniHash($an))->get();

    //     foreach ( $admissions as $admission ) {
    //         if ( $admission->an == $an ) {
    //             return static::find($admission->id);
    //         }
    //     }

    //     return null;
    // }

    public function getLenghtOfStay()
    {
        return $this->datetime_admit && $this->datetime_discharge
               ? $this->datetime_discharge->diffInDays($this->datetime_admit) . ' days'
               : null;
    }

    public function genExtraFields()
    {
        $this->lenght_of_stay = $this->getLenghtOfStay();
        $this->datetime_admit_formated = $this->datetime_admit->format('d M Y H:i');
        $this->datetime_discharge_formated = $this->datetime_discharge->format('d M Y H:i');
        $this->comorbids = $this->diagnosis()->comorbid()->select('name as value')->get();
        $this->complications = $this->diagnosis()->complication()->select('name as value')->get();
        $this->other_diagnosis = $this->diagnosis()->other()->select('name as value')->get();
        $this->external_causes = $this->diagnosis()->external()->select('name as value')->get();
        $this->principle_diagnosis = $this->diagnosis()->principle()->select('name as value')->get();
    }

    public function diagnosis()
    {
        return $this->hasMany(AdmissionDiagnosis::class);
    }

    public function autosave($field, $value)
    {
        switch ($field) {
            case 'comorbids':
                return $this->putDiagnosis('comorbid', $value);
            case 'complications':
                return $this->putDiagnosis('complication', $value);
            case 'external_causes':
                return $this->putDiagnosis('external', $value);
            case 'other_diagnosis':
                return $this->putDiagnosis('other', $value);
            case 'principle_diagnosis':
                return $this->putDiagnosis('principle', $value);
            default :
                return $field;
        }
        return $value;
    }

    protected function putDiagnosis($tag, $list)
    {
        AdmissionDiagnosis::where(['admission_id' => $this->id, 'tag' => $tag])->delete();
        foreach ( $list as $index => $item ) {
            if ( $item['value'] !== null ) {
                $admissionDiagnosis = AdmissionDiagnosis::create([
                    'tag' => $tag,
                    'order' => ($index + 1),
                    'name' => $item['value'],
                    'admission_id' => $this->id,
                ]);
            }
        }
        return true;
    }
}
