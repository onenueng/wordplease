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
        'class_path',
        'division_id',
    ];

    /**
     * Set of note name and class that can be retitle.
     *
     * @var array
     */
    protected $retitledNotes = [ // Title => Class
        'Admission Note' => 1,
        'Discharge Summary' => 2,
        'On service note' => 3,
        'Off service note' => 3,
        'Transfer note' => 3,
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function canRetitledTo()
    {
        
        if ( $this->class > 2 ) { // class > 2 = service note. Not allow to retitle.
            return [];
        }

        $noteTitles = [];
        foreach( $this->retitledNotes as $title => $class ) {
            if ( $this->class != $class ) {
                $noteTitles[] = $title;
            }
        }

        return $noteTitles;
    }

    public function creatable($an, $gender, $class, $userId)
    {
        if ( !app('db')->table('note_type_user')
                       ->where('note_type_id', $this->id)
                       ->where('user_id', $userId)
                       ->count() ) {
            return "Your are not allowed";
        } else if ( !($this->gender == 2 or $this->gender == $gender) ) { // check match gender
            return "Patient's gender not match the selected note";
        } elseif ( $class < 3 && !(Note::uniqueRuleChecked($an, $class)) ) { // check unique rule
            return "The " . ($class == 1 ? 'admission':'discharge') . " note of this AN already exists";
        }

        return '';        
    }

    public function getCreateDescription($an, $gender, $userId, $retitle = false)
    {
        $title = '';
        $creatable = true;
        $class = $retitle ? $this->retitledNotes[$retitle] : $this->class;

        $result = $this->creatable($an, $gender, $class, $userId);
        if ( $result != '' ) {
            $creatable = false;
            $title = $result;
        }

        return [
            'label' => $this->name . ( $retitle ? (' retitle to ' . $retitle) : '' ),
            'title' => $title,
            'class' => $class,
            'retitle' => $retitle ? $retitle:'',
            'creatable' => $creatable,
            'noteTypeId' => $this->id,
        ];
    }

}
