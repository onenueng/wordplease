<?php

namespace App\Models\Lists;

use App\User;
use App\Models\Notes\Note;
use App\Contracts\AutoId;
use App\Models\Lists\Division;
use App\Traits\DataImportable;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class NoteType extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'class', // admission/discharge/service.
        'gender', // 0 => female only/ 1 => male only/ 2 => all gender.
        'view_path',
        'table_name',
        'division_id',
        'resource_name',
    ];

    protected $retitledNotes = [
        ['title' => 'Admission Note', 'class' => 1],
        ['title' => 'Discharge Summary', 'class' => 2],
        ['title' => 'On service note', 'class' => 3],
        ['title' => 'Off service note', 'class' => 3],
        ['title' => 'Transfer note', 'class' => 3]
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function canRetitledTo()
    {
        $noteTitles = [];
        if ( $this->class > 2 ) {
            return $noteTitles;
        }

        foreach( $this->retitledNotes as $note ) {
            if ( $this->class != $note['class'] ) {
                $noteTitles[] = $note['title'];
            }
        }

        return $noteTitles;
    }

    public function getCreateDescription($an, $gender, $retitle = false)
    {
        $creatable = true;
        $title = '';

        if ( !($this->gender == 2 or $this->gender == $gender) ) { // check match gender
            $creatable = false;
            $title = "Patient's gender not match the selected note";
        } elseif ( $this->class < 3 && !Note::uniqueRuleChecked($an, $this->id, $this->class) ) {
            $creatable = false;
            $title = "The " . ($this->class == 1 ? 'admission':'discharge') . " note of this AN already exists";
        }

        return [
            'note_type_id' => $this->id,
            'retitle' => $retitle ? $retitle:'',
            'label' => $this->name . ( $retitle ? (' retitle to ' . $retitle) : '' ),
            'title' => $title,
            'creatable' => $creatable
        ];
    }

}
