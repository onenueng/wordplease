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

    public static function loadItems($fileName, $mode = 'insert')
    {
        $isBreak = ( $fileName != 'all' );

        switch ($fileName) {
            case 'divisions':
                $model = '\App\Models\Lists\Division';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            case 'roles':
                $model = '\App\Models\Lists\Role';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            case 'permissions':
                $model = '\App\Permission';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            case 'note_types':
                $model = '\App\Models\Lists\NoteType';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            case 'attending_staffs':
                $model = '\App\Models\Lists\AttendingStaff';
                static::insertItems($model, $fileName, $mode);
                if ( $isBreak ) break;

            case 'wards':
                $model = '\App\Models\Lists\Ward';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            case 'select_items':
                $model = '\App\Models\Lists\SelectItem';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            case 'drugs':
                $model = '\App\Models\Lists\Drug';
                static::insertItems($model, $fileName, $mode);
                if ($isBreak) break;

            default:
                # code...
                break;
        }

        return $model::count();
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
