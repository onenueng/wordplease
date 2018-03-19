<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Traits\DataCryptable;
use App\Models\Lists\Patient;
use App\Models\Lists\Insurance;
use App\Traits\AutoIdInsertable;
use App\Traits\DatetimeHandleable;
use Illuminate\Database\Eloquent\Model;

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

    public static function findByAn($an)
    {
        $admissions = static::select('id', 'an')->where('mini_hash', (new static)->miniHash($an))->get();

        foreach ( $admissions as $admission ) {
            if ( $admission->an == $an ) {
                return static::find($admission->id);
            }
        }

        return null;
    }
}
