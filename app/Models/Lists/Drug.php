<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DataImportable;

class Drug extends Model
{
    use DataImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'generic_name',
        'trade_name',
        'synonyms',
        'key',
    ];

    /**
     * Get Id type of the model.
     *
     * @return stirng
     */
    public static function getIdType()
    {
        return 'id';
    }

    public static function search($key)
    {
        $start = microtime(true);
        $cri = '%' . $key . '%';
        $query = static::select('id', 'name')
                            ->where('name', 'like', $cri)
                            ->orWhere('generic_name', 'like', $cri)
                            ->orWhere('trade_name', 'like', $cri)
                            ->orWhere('synonyms', 'like', $cri)
                            ->get();
        return microtime(true) - $start;
    }

    public static function search2($key)
    {
        $start = microtime(true);
        $cri = "%";
        for ($i = 0; $i < strlen($key); $i++)
            $cri .= ($key[$i] . '%');

        $query = static::select('id', 'name')
                            ->where('name', 'like', $cri)
                            ->orWhere('generic_name', 'like', $cri)
                            ->orWhere('trade_name', 'like', $cri)
                            ->orWhere('synonyms', 'like', $cri)
                            ->get();
        return microtime(true) - $start;
    }
    
}
