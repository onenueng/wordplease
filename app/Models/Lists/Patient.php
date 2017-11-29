<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\DataCryptable;

class Patient extends Model implements AutoId
{
    use AutoIdInsertable, DataCryptable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'document_id',
        'hn',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'spouse',
        'address',
        'postcode_id',
        'tel_no',
        'alternative_contact',
    ];

    /**
     * Get Id type of the model.
     *
     * @return stirng
     */
    public static function getIdType()
    {
        return 'time_based_uuid';
    }

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
}
