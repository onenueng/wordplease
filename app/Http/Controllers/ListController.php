<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lists\SelectItem;

class ListController extends Controller
{
    /**
     * Return input select choices by field_name.
     * 
     * @param  String  $fieldName
     * @return \Illuminate\Http\Response
     */
    public function getSelectChoices($fieldName)
    {
        // return data must compile a devbrigde autocomplete jquery plug-in format, like this. 
        $items['suggestions'] = SelectItem::select('label as value', 'value as data')
                                ->where('field_name', $fieldName)
                                ->orderBy('order')
                                ->get();
        return response()->json($items);
    }
}
