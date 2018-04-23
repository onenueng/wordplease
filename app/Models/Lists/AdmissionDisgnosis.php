<?php

namespace App\Models\Lists;

use App\Models\Lists\Admission;
use Illuminate\Database\Eloquent\Model;

class AdmissionDiagnosis extends Model
{
    protected $table = 'admission_diagnosis';

    protected $fillable = [
        'tag',
        'name',
        'order',
        'admission_id',
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function scopeComorbid($query)
    {
        return $query->select(['name', 'admission_id'])->where('tag', 'comorbid')->orderBy('order');
    }
}
