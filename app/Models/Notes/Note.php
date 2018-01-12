<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\DataCryptable;

class Note extends Model implements AutoId
{
    use AutoIdInsertable, DataCryptable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'an',
        'note_type_id',
        'note_content_id',
        'datetime_admit',
        'datetime_discharge',
        'ward_id',
        'attending_staff_id',
        'division_id'
    ];

    public static function willComplyUniqueRule($an, $noteTypeId)
    {
        if ( $noteTypeId > 2 ) {
            return false;
        }

        $notes = static::where('note_type_id', $noteTypeId)
                         ->where('mini_hash', (new static)->miniHash($an))
                         ->get();

        foreach ( $notes as $note ) {
            if ( $note->an == $an ) {
                return false;
            }
        }

        return true;
    }

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
}
