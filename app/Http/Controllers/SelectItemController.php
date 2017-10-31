<?php

namespace App\Http\Controllers;

use App\Models\Lists\SelectItem;
use Illuminate\Http\Request;

class SelectItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function query($fieldName)
    {
        $items['suggestions'] = SelectItem::select('label as value', 'value as data')
                                ->where('field_name', $fieldName)
                                ->orderBy('order')
                                ->get();
        return response()->json($items);
    }
}
