<?php

namespace App\Models\Notes;

use App\User;
use App\Contracts\AutoId;
use App\Models\Lists\Ward;
use App\Traits\DataCryptable;
use App\Models\Lists\NoteType;
use App\Models\Lists\Division;
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

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function detail()
    {
        return $this->hasOne($this->noteType->class_path, 'id', 'id');
    }

    public function wardName()
    {
        return $this->ward_id ? $this->ward->name : $this->ward_other;
    }

    public function attendingName()
    {
        return $this->attending_staff_id ? $this->attending->name : $this->attending_staff_other;
    }

    public function divisionName()
    {
        return $this->division_id ? $this->division->name : $this->division_other;
    }

    public function autosave($field, $value)
    {
        if ( $field == 'attending' ) { $field .= '_staff'; }

        $id = app('db')->table(str_plural($field))->select('id')->where('name', $value)->first();
        $fieldId = $field . '_id';
        if ($id) {
            $this->$fieldId = $id->id;
            return $this->save();
        }
        $fieldOther = $field . '_other';
        $this->$fieldId = 0;
        $this->$fieldOther = $value;
        return $this->save();
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

    public function genExtraFields()
    {
        $this->ward_name = $this->wardName();
        $this->attending_name = $this->attendingName();
        $this->division_name = $this->divisionName();
    }

    public static function uniqueRuleChecked($an, $class)
    {
        $admission = Admission::findByCryptedKey($an, 'an');

        if ( !$admission ) {
            return true;
        }

        return !Note::where('admission_id', $admission->id)->where('class', $class)->count();
    }
}
