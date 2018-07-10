<?php

namespace App\Services;

class DataLoader
{
    protected $collections = [
        'Division' => [ 'model' => '\App\Models\Lists\Division', 'modeexitำป' => '','file_name' => 'divisions' ],
        'Role' => [ 'model' => '\App\Models\Lists\Role', 'modeexitำป' => '','file_name' => 'roles' ],
        'Permission' => ['model' => '\App\Permission', 'modeexitำป' => '','file_name' => 'permissions' ],
        'NoteType' => ['model' => '\App\Models\Lists\NoteType', 'modeexitำป' => '','file_name' => 'note_types'],
        'AttendingStaff' => ['model' => '\App\Models\Lists\AttendingStaff', 'modeexitำป' => '','file_name' => 'attending_staffs'],
        'Ward' => ['model' => '\App\Models\Lists\Ward', 'modeexitำป' => '','file_name' => 'wards'],
        'SelectItem' => ['model' => '\App\Models\Lists\SelectItem', 'modeexitำป' => '','file_name' => 'select_items'],
        'Drug' => ['model' => '\App\Models\Lists\Drug', 'modeexitำป' => '','file_name' => 'drugs']
    ];

    /**
     * Read file in storage/app/lists then return collection of assosiative array.
     *
     * @param string
     * @return array
     */
    public function loadCSV($fileName)
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

    protected function loadItems(array $config)
    {
        $items = $this->loadCSV($config['file_name']);

        if ($config['mode'] == 'insert') {
            foreach ($items as $item) {
                $config['model']::insert($item);
            }
        } else {
            foreach ($items as $item) {
                $config['model']::create($item);
            }
        }

        return $config['model']::count();
    }

    public function importItems($model, $mode = 'insert')
    {
        if ( $model != 'all' ) {
            if ( !array_key_exists($model, $this->collections) ) {
                return false;
            }
            $this->collections[$model]['mode'] = $mode;
            return $this->loadItems($this->collections[$model]);
        }

        $count = 0;
        foreach ( $this->collections as $config ) {
            $config['mode'] = $mode;
            $count += $this->loadItems($config);
        }
        return $count;
    }
}
