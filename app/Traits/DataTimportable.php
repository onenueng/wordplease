<?php

namespace App\Traits;

trait DataImportable
{
    /**
     * Read file in storage/csv then return collection of assosiative array.
     *
     * @param string
     * @return array
     */
    protected static function loadCSV($fileName)
    {
        $fileName = storage_path(). '/data/' . $fileName . '.csv';
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
     * Read file in storage/csv then return collection of assosiative array.
     *
     * @param string
     * @return boolean
     */
    public static function loadData($fileName, $mode = 'insert')
    {
        $data = static::loadCSV($fileName);

        if ($data) {
            if ($mode == 'insert') {
                foreach ($data as $row) {
                    static::insert($row);
                }
            } else {
                foreach ($data as $row) {
                    static::create($row);
                }
            }
            return true;
        }

        return false;
    }
}
