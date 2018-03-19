<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Traits\DataImportable;
use App\Models\Lists\Admission;
use App\Traits\AutoIdInsertable;
use App\Traits\RuntimeMaintainable;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable, RuntimeMaintainable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
    ];

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
