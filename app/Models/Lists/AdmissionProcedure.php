<?php

namespace App\Models\Lists;

use App\Models\Lists\Admission;
use Illuminate\Database\Eloquent\Model;

class AdmissionProcedure extends Model
{
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

    public function scopeNonOR($query)
    {
        return $query->where('tag', 'non OR')->orderBy('order');
    }

    public function scopeOR($query)
    {
        return $query->where('tag', 'OR')->orderBy('order');
    }
}
