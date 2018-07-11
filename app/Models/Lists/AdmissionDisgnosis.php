<?php

namespace App\Models\Lists;

use App\Models\Lists\Admission;
use Illuminate\Database\Eloquent\Model;

class AdmissionDiagnosis extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s.u';
    
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

    public function scopePrinciple($query)
    {
        return $query->where('tag', 'principle')->orderBy('order');
    }

    public function scopeComorbid($query)
    {
        return $query->where('tag', 'comorbid')->orderBy('order');
    }

    public function scopeComplication($query)
    {
        return $query->where('tag', 'complication')->orderBy('order');
    }

    public function scopeExternal($query)
    {
        return $query->where('tag', 'external')->orderBy('order');
    }

    public function scopeOther($query)
    {
        return $query->where('tag', 'other')->orderBy('order');
    }
}
