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
}
