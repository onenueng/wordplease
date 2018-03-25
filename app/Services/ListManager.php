<?php

namespace App\Services;

class ListManager
{
    public function getId($field, $value)
    {
        switch ($field) {
            case 'ward':
                $class = '\App\Models\Lists\Ward';
                break;

            case 'division':
                $class = '\App\Models\Lists\Division';
                break;

            case 'attending':
                $class = '\App\Models\Lists\AttendingStaff';
                break;
            
            default:
                $class = '\App\Models\Lists\SelectItem';
                break;
        }

        // $class::foundOrNew();
    }
}
