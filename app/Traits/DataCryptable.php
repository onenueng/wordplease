<?php

namespace App\Traits;

trait DataCryptable
{
    /**
     * Use Illuminate\Contracts\Encryption\Encrypter to encrypt data.
     *
     * @param  string  $value
     * @return string|null
     */
    public function encryptField($value)
    {
        return ($value == '') ? null : resolve('Illuminate\Contracts\Encryption\Encrypter')->encrypt($value);
    }

    /**
     * Use Illuminate\Contracts\Encryption\Encrypter to decrypt data.
     *
     * @param  string  $value
     * @return string|null
     */
    public function decryptField($value)
    {
        return is_null($value) ? null : resolve('Illuminate\Contracts\Encryption\Encrypter')->decrypt($value);
    }

    /**
     * Use hmac with sha256 algorithm to hash data then get small portion by substr.
     *
     * @param  string  $value
     * @return string|null
     */
    public function miniHash($value)
    {
        return substr(hash_hmac("sha256", $value, config('app.key')), config('constant.MINI_HASH_START_AT'), config('constant.MINI_HASH_LENGTH'));
    }

    public function tryUpdate(Array $data)
    {
        $dirty = false;
        foreach ( $this->fillable as $field) {
            if ( array_key_exists($field, $data) && $this->$field != $data[$field] ) {
                $this->$field = $data[$field];
                $dirty = true;
            }
        }

        if ( $dirty ) {
            return $this->save();
        }
        return false;
    }

    public static function findByCryptedKey($keyValue, $keyName)
    {
        $records = static::select('id', $keyName)->where('mini_hash', (new static)->miniHash($keyValue))->get();

        foreach ( $records as $record ) {
            if ( $record->$keyName == $keyValue ) {
                return static::find($record->id);
            }
        }

        return null;
    }
}
