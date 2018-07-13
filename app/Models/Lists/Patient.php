<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Traits\DataCryptable;
use App\Models\Lists\Admission;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model implements AutoId
{
    use AutoIdInsertable, DataCryptable;

    // protected $dateFormat = 'Y-m-d H:i:s.u';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'hn',
        'dob',
        'tel_no',
        'gender',
        'spouse',
        // 'address',
        'last_name',
        'first_name',
        'middle_name',
        'document_id',
        'alternative_contact',
    ];

    /**
     * Set field 'hn'.
     *
     * @param string $value
     */
    public function setHnAttribute($value)
    {
        $this->attributes['hn'] = $this->encryptField($value);
        $this->attributes['mini_hash'] = $this->miniHash($value);
    }

    /**
     * Get field 'hn'.
     *
     * @return string
     */
    public function getHnAttribute()
    {
        return $this->decryptField($this->attributes['hn']);
    }

    protected function handleOldName($name, &$newData) {
        if ( array_key_exists($name, $this->attributes) && $this->attributes[$name] !== NULL ) { // has previous data
            $lastData = $this->decryptField($this->attributes[$name]);
            if ( $lastData != NULL && $lastData != $newData ) { // data changed
                if ( isset($this->attributes[$name . '_old']) ) { // has previous oldName
                    $this->attributes[$name . '_old'] = $this->encryptField($this->decryptField($this->attributes[$name . '_old']). $lastData . ',');
                } else {
                    $this->attributes[$name . '_old'] = $this->encryptField($lastData . ',');
                }
            }
        }

        $this->attributes[$name] = $this->encryptField($newData);
    }

    /**
     * Set field 'first_name'.
     *
     * @param string $value
     */
    public function setFirstNameAttribute($value)
    {
        // $this->attributes['first_name'] = $this->encryptField($value);
        $this->handleOldName('first_name', $value);
    }

    /**
     * Get field 'first_name'.
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        return $this->decryptField($this->attributes['first_name']);
    }

    /**
     * Get field 'first_name_old'.
     *
     * @return string
     */
    public function getFirstNameOldAttribute()
    {
        return $this->decryptField($this->attributes['first_name_old']);
    }

    /**
     * Set field 'middle_name'.
     *
     * @param string $value
     */
    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = $this->encryptField($value);
    }

    /**
     * Get field 'middle_name'.
     *
     * @return string
     */
    public function getMiddleNameAttribute()
    {
        return $this->decryptField($this->attributes['middle_name']);
    }

    /**
     * Set field 'last_name'.
     *
     * @param string $value
     */
    public function setLastNameAttribute($value)
    {
        // $this->attributes['last_name'] = $this->encryptField($value);
        $this->handleOldName('last_name', $value);

    }

    /**
     * Get field 'last_name'.
     *
     * @return string
     */
    public function getLastNameAttribute()
    {
        return $this->decryptField($this->attributes['last_name']);
    }

    /**
     * Get field 'last_name_old'.
     *
     * @return string
     */
    public function getLastNameOldAttribute()
    {
        return $this->decryptField($this->attributes['last_name_old']);
    }

    /**
     * Set field 'document_id'.
     *
     * @param string $value
     */
    public function setDocumentIdAttribute($value)
    {
        $this->attributes['document_id'] = $this->encryptField($value);
    }

    /**
     * Get field 'document_id'.
     *
     * @return string
     */
    public function getDocumentIdAttribute()
    {
        return $this->decryptField($this->attributes['document_id']);
    }

    /**
     * Set field 'spouse'.
     *
     * @param string $value
     */
    public function setSpouseAttribute($value)
    {
        $this->attributes['spouse'] = $this->encryptField($value);
    }

    /**
     * Get field 'spouse'.
     *
     * @return string
     */
    public function getSpouseAttribute()
    {
        return $this->decryptField($this->attributes['spouse']);
    }

    // /**
    //  * Set field 'address'.
    //  *
    //  * @param string $value
    //  */
    // public function setAddressAttribute($value)
    // {
    //     $this->attributes['address'] = $this->encryptField($value);
    // }

    // /**
    //  * Get field 'address'.
    //  *
    //  * @return string
    //  */
    // public function getAddressAttribute()
    // {
    //     return $this->decryptField($this->attributes['address']);
    // }

    /**
     * Set field 'tel_no'.
     *
     * @param string $value
     */
    public function setTelNoAttribute($value)
    {
        $this->attributes['tel_no'] = $this->encryptField($value);
    }

    /**
     * Get field 'tel_no'.
     *
     * @return string
     */
    public function getTelNoAttribute()
    {
        return $this->decryptField($this->attributes['tel_no']);
    }

    /**
     * Set field 'alternative_contact'.
     *
     * @param string $value
     */
    public function setAlternativeContactAttribute($value)
    {
        $this->attributes['alternative_contact'] = $this->encryptField($value);
    }

    /**
     * Get field 'alternative_contact'.
     *
     * @return string
     */
    public function getAlternativeContactAttribute()
    {
        return $this->decryptField($this->attributes['alternative_contact']);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    // public static function findByHn($hn)
    // {
    //     $patients = static::select('id', 'hn')->where('mini_hash', (new static)->miniHash($hn))->get();

    //     foreach ( $patients as $patient ) {
    //         if ( $patient->hn == $hn ) {
    //             return static::find($patient->id);
    //         }
    //     }

    //     return null;
    // }
}
