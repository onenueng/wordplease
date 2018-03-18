<?php

namespace App\Models\Notes;

use App\User;
use App\Contracts\AutoId;
use App\Traits\DataCryptable;
use App\Models\Lists\NoteType;
use App\Models\Lists\Admission;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Note extends Model implements AutoId
{
    use AutoIdInsertable, DataCryptable;

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

    public static function uniqueRuleChecked($an, $class)
    {
        $instance = new static;

        // $notes = app('db')->table('notes')
        //                   ->join('note_types', 'note_types.id', '=', 'notes.note_type_id')
        //                   ->select('notes.an')
        //                   ->where('notes.mini_hash', $instance->miniHash($an))
        //                   ->where('note_types.class', $class)
        //                   ->get();
        // $notes = static::select('an', 'class')->where('mini_hash', $instance->miniHash($an))->get();

        $admission = Admission::findByAn($an);

        if ( !$admission ) {
            return true;
        }

        $notes = Note::where('admission_id', $admission->id)->where('class', $class)->get();
        
        foreach ( $notes as $note ) {
            if ( ($instance->decryptField($note->an) == $an) ) {
                return false;
            }
        }

        return true;
    }
}
