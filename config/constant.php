<?php

return [
    'MINI_HASH_START_AT' => 13, // cannot change after go live
    'MINI_HASH_LENGTH' => 7, // please review migration if changed, cannot change after go live
    'VERIFY_CODE_LENGTH' => 6, // length in digits
    'EMAIL_ACCOUNT_DEFAULT_LIFETIME' => 30, // days
    'DEFAULT_USER_DIVISION_ID' => 100, //
    'LISTS_CSV_PATH' => '/app/lists/',
    'USER_DATA_FROM_API_CACHE_LIFETIME' => 120 // minutes
];
