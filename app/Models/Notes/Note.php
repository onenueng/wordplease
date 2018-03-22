<?php

namespace App\Models\Notes;

use App\User;
use App\Contracts\AutoId;
use App\Models\Lists\Ward;
use App\Traits\DataCryptable;
use App\Models\Lists\NoteType;
use App\Models\Lists\Admission;
use App\Traits\AutoIdInsertable;
use App\Models\Lists\AttendingStaff;
use Illuminate\Database\Eloquent\Model;

class Note extends Model implements AutoId
{
    use AutoIdInsertable, DataCryptable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'UUID'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'class',
        'ward_id',
        'retitle',
        'created_by',
        'note_type_id',
        'admission_id',
        'attending_staff_id',
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

    public function noteType()
    {
        return $this->belongsTo(NoteType::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function attending()
    {
        return $this->belongsTo(AttendingStaff::class, 'attending_staff_id');
    }

    public static function uniqueRuleChecked($an, $class)
    {
        $admission = Admission::findByAn($an);

        if ( !$admission ) {
            return true;
        }

        return !Note::where('admission_id', $admission->id)->where('class', $class)->count();
    }

    public function editUrl()
    {
        return '/note/' . $this->id . '/edit';
    }

    public function brandNavbar()
    {
        return $this->noteType->name . ' @ ' . $this->admission->an;
    }

    public function titleNavbar()
    {
        return $this->admission->patient_name
                 . " <i class='fa fa-"
                 . ($this->admission->patient->gender ? 'mars' : 'venus') . "'></i>";
    }

    public function jsPath()
    {
        return '/js/' . str_replace('notes', 'note', str_replace('_', '-', ($this->noteType->table_name))) . '.js';
    }
}
