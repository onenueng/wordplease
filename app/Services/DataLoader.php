<?php

namespace App\Services;

class DataLoader
{
    /**
     * config of collection
     */
    protected $collections = [
        'Division' => [ 'model' => '\App\Models\Lists\Division','file_name' => 'divisions' ],
        'Role' => [ 'model' => '\App\Models\Lists\Role','file_name' => 'roles' ],
        'Permission' => ['model' => '\App\Permission','file_name' => 'permissions' ],
        'NoteType' => ['model' => '\App\Models\Lists\NoteType','file_name' => 'note_types'],
        'AttendingStaff' => ['model' => '\App\Models\Lists\AttendingStaff','file_name' => 'attending_staffs'],
        'Ward' => ['model' => '\App\Models\Lists\Ward','file_name' => 'wards'],
        'SelectItem' => ['model' => '\App\Models\Lists\SelectItem','file_name' => 'select_items'],
        'Drug' => ['model' => '\App\Models\Lists\Drug','file_name' => 'drugs']
    ];

    /**
     * Read the file then return collection of assosiative array.
     *
     * @param  string $fileName
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

    /**
     * Load data from csv to table
     *
     * @param  array $config
     * @return integer
     */
    protected function loadItems(array $config)
    {
        $items = $this->loadCSV($config['file_name']);

        $model = $config['model'];
        
        if ($config['mode'] == 'insert') {
            foreach ($items as $item) {
                $model::insert($item);
            }
        } else {
            foreach ($items as $item) {
                $model::create($item);
            }
        }

        return $model::count();
    }

    /**
     * Import data to table
     *
     * @param  string $model
     * @param  string $mode
     * @return mixed
     */
    public function importItems($model, $mode = 'create')
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

    /**
     * Reload data from csv to table
     *
     * @param  string @model
     * @param  string @mode
     * @return mixed
     */
    public function reloadItems($model, $mode = 'create')
    {
        if (!array_key_exists($model, $this->collections)) {
            return false;
        }

        $this->collections[$model]['model']::truncate();

        $this->collections[$model]['mode'] = $mode;
        return $this->loadItems($this->collections[$model]);
    }
}
