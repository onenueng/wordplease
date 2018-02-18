<?php

namespace App;

use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\DataCryptable;

class User extends Authenticatable implements AutoId
{
    use Notifiable, AutoIdInsertable, DataCryptable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'pln',
        'name',
        'email',
        'org_id',
        'password',
        'full_name',
        'full_name_en',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Set field 'name'.
     *
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $this->encryptField($value);
    }
    /**
     * Get field 'name'.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->decryptField($this->attributes['name']);
    }

    /**
     * Set field 'org_id'.
     *
     * @param string $value
     */
    public function setOrgIdAttribute($value)
    {
        $this->attributes['org_id'] = $this->encryptField($value);
        $this->attributes['mini_hash'] = $this->miniHash($value);
    }
    /**
     * Get field 'org_id'.
     *
     * @return string
     */
    public function getOrgIdAttribute()
    {
        return $this->decryptField($this->attributes['org_id']);
    }

    /**
     * Set field 'password'.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value == null ? null : bcrypt($value);
    }

    /**
     * Set field 'email'.
     *
     * @param string $value
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $this->encryptField($value);
        $this->genVerifyCode();
    }
    /**
     * Get field 'email'.
     *
     * @return string
     */
    public function getEmailAttribute()
    {
        return $this->decryptField($this->attributes['email']);
    }

    /**
     * Set field 'full_name'.
     *
     * @param string $value
     */
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = $this->encryptField($value);
    }
    /**
     * Get field 'full_name'.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->decryptField($this->attributes['full_name']);
    }

    /**
     * Set field 'full_name_en'.
     *
     * @param string $value
     */
    public function setFullNameEnAttribute($value)
    {
        $this->attributes['full_name_en'] = $this->encryptField($value);
    }
    /**
     * Get field 'full_name_en'.
     *
     * @return string
     */
    public function getFullNameEnAttribute()
    {
        return $this->decryptField($this->attributes['full_name_en']);
    }

    /**
     * Generate multi digits code for verification.
     *
     * @return String
     */
    public function genVerifyCode()
    {
        // $max = str_pad('', config('constant.VERIFY_CODE_LENGTH'), '9');
        $this->attributes['verify_code'] = str_pad(
            mt_rand(1, str_pad('', config('constant.VERIFY_CODE_LENGTH'), '9')),
            config('constant.VERIFY_CODE_LENGTH'),
            '0',
            STR_PAD_LEFT
        );
    }

    public function authorizes()
    {
        return $this->belongsToMany('\App\Authorize');
    }

    public static function findByUniqueField($field, $value)
    {
        if ( $field == 'org_id' ) {
            $users = static::where('mini_hash', (new static)->miniHash($value))->get();
            if ( count($users) == 1 ) {
                return $users[0];
            }
        } else {
            $users = static::all();
        }

        foreach ($users as $user ) {
            if ( $user->$field == $value ) {
                return $user;
            }
        }

        return null;
    }
}
