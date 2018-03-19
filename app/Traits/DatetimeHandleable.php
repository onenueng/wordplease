<?php

namespace App\Traits;

use Carbon\Carbon;

trait DatetimeHandleable
{
    protected function handleDatetime($value)
    {
        if ( !$value ) {
            return null;
        } 

        return Carbon::parse($value)->toDatetimeString();
    }
}
