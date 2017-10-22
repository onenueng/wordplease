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
        'an'
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
