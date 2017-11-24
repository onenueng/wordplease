<?php

namespace App\Traits;

trait ListQueryable
{

    /**
     * Get fields whiches selected for query.
     *
     * @return array
     */
    public static function selectFields()
    {
        return ['id as data', 'name as value'];
    }

    /**
     * Get fields whiches make where(or) in the query.
     *
     * @return array
     */
    public static function whereFields()
    {
        return ['name'];
    }
    
    /**
     * Get list of list.
     *
     * @return array
     */
    public static function getList($keyWord)
    {
        $query = static::extraProcedure($keyWord);
        if (count($query) > 0) {
            return $query;
        }

        $rowsLimit = 50; // limit rows result

        /**
         * Search keyword partial match like '%keyword%'
         */
        $pattern = '%' . $keyWord . '%';
        $query = static::select(static::selectFields());
        foreach (static::whereFields() as $field) {
            $query = $query->orWhere($field, 'like', $pattern); 
        }

        $partialMatched = $query->limit($rowsLimit)->get()->toArray();

        // check if matched result reach limit then return
        if (count($partialMatched) >= $rowsLimit) {
            return $partialMatched;
        }
        
        /**
         * Search keyword in letters order match like '%k%e%y%w%o%r%d%'
         */
        $pattern = static::getSearchPattern($keyWord);
        $query = static::select(static::selectFields());
        foreach (static::whereFields() as $field) {
            $query = $query->orWhere($field, 'like', $pattern); 
        }

        $letterOrderMatched = $query->limit($rowsLimit)->get()->toArray();

        // check if no matched result then return $partialMatched
        if (count($letterOrderMatched) == 0) {
            return $partialMatched;
        }

        // check if no matched result for $partialMatched then
        // return $letterOrderMatched or continue combind
        // process by get data key from $partialMatched
        if (count($partialMatched) == 0) {
            return $letterOrderMatched;
        } else {
            $key = array_keys($partialMatched[0])[0];
        }

        foreach($letterOrderMatched as $row) {
            $match = false;
            foreach ($partialMatched as $item) {
                if ($row[$key] == $item[$key]) {
                    $match = true;
                    break;
                }
            }

            // if $row not exist in $partialMatched
            // then add $row to $partialMatched
            if (!$match) {
                $partialMatched[] = $row;
            }

            if (count($partialMatched) >= $rowsLimit) {
                return $partialMatched;
            }
        }
        
        return $partialMatched;
    }

    /**
     * Generate keyword in pattern like '%k%e%y%w%o%r%d%'
     *
     * @return string
     */
    protected static function getSearchPattern($keyWord)
    {
        $pattern = '%';
        for ($i=0; $i < strlen($keyWord); $i++) {
            $pattern .= (mb_substr($keyWord, $i, 1) . '%');
        }
        return $pattern;
    }

    /**
     * Specific procedure for specific list class
     *
     * @return string
     */
    protected static function extraProcedure($keyWord)
    {
        return [];
    }
}
