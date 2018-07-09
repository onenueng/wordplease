<?php

namespace App\Services;

class DataLoader
{
    /**
     * Read file in storage/app/lists then return collection of assosiative array.
     *
     * @param string
     * @return array
     */
    public static function loadCSV($fileName)
    {
        $fileName = storage_path(config('constant.LISTS_CSV_PATH') . $fileName . '.csv');
        if (!file_exists($fileName) || !is_readable($fileName)) {
            return [];
        } else {
            $header = null;
            if (($handle = fopen($fileName, 'r')) !== false) {
                while (($row = fgetcsv($handle, 3000, ",")) !== false) { // 3000 = max lenght of longest line
                    if (!$header) {
                        $header = $row;
                    } else {
                        $data[] = array_combine($header, $row);
                    }
                }
            }
            fclose($handle);
            return $data;
        }
    }

    public static function loadItems($model, $mode = 'insert')
    {
        $isBreak = ($model != 'all');

        switch ($model) {
            case 'divisions':
                static::insertItems('\App\Models\Lists\Division', $model, $mode);
                if ($isBreak) break;

            case 'roles':
                static::insertItems('\App\Models\Lists\Role', $model, $mode);
                if ($isBreak) break;

            case 'permissions':
                static::insertItems('\App\Permission', $model, $mode);
                if ($isBreak) break;

            case 'note_types':
                static::insertItems('\App\Models\Lists\NoteType', $model, $mode);
                if ($isBreak) break;

            case 'attending_staffs':
                static::insertItems('\App\Models\Lists\AttendingStaff', $model, $mode);
                if ( $isBreak ) break;

            case 'wards':
                static::insertItems('\App\Models\Lists\Ward', $model, $mode);
                if ($isBreak) break;

            case 'select_items':
                static::insertItems('\App\Models\Lists\SelectItem', $model, $mode);
                if ($isBreak) break;

            case 'drugs':
                static::insertItems('\App\Models\Lists\Drug', $model, $mode);
                if ($isBreak) break;

            default:
                # code...
                break;
        }

        return 'done';
    }

    public static function insertItems($model, $fileName, $mode)
    {
        $items = static::loadCSV($fileName);

        if ( $mode == 'insert' ) {
            foreach ( $items as $item ) {
                $model::insert($item);
            }

            return true;
        }

        foreach ($items as $item) {
            $model::create($item);
        }

        return true;
    }
}