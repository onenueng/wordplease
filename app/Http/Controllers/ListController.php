<?php

namespace App\Http\Controllers;

// use DB;
use Illuminate\Http\Request;
use App\Models\Lists\SelectItem;
use App\Models\Lists\AttendingStaff as Attending;



class ListController extends Controller
{
    /**
     * Return input select choices by field_name.
     *
     * @param  String  $type, $listName
     * @return \Illuminate\Http\Response
     */
    public function getList($type, $listName, Request $request)
    {
        /**
         *
         * data must compile a devbrigde autocomplete jquery plug-in format,
         * {"suggestions": [{"value": "", "data":, ""},{},...]}.
         *
         */

        if ($type == 'select') {
            $items['suggestions'] = SelectItem::select('label as value', 'value as data')
                                    ->where('field_name', $listName)
                                    ->orderBy('order')
                                    ->get();
            return response()->json($items);
        }

        $query = $request->input('query');
        switch ($listName) {
            case 'attending' :
                $data = $this->getAttending($request->input('query'));
                break;
        }

        $items['suggestions'] = $data;
        return response()->json($items);
    }

    protected function getAttending($query)
    {
        return Attending::select('id as data', 'name as value')
                          ->where('name', 'like', $this->getSearchCondition($query))
                          ->get();
    }

    protected function getSearchCondition($query)
    {
        $pattern = '%';
        for ($i=0; $i < strlen($query); $i++) { 
            $pattern .= (mb_substr($query, $i, 1) . '%');
        }
        return $pattern;
    }
}
