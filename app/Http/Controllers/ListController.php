<?php

namespace App\Http\Controllers;

use App\Models\Lists\AttendingStaff as Attending;
use App\Models\Lists\Division;
use App\Models\Lists\SelectItem;
use App\Models\Lists\Ward;
use Illuminate\Http\Request;

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

        switch ($listName) {
            case 'attending':
                $data = $this->getAttendingList($request->input('query'));
                break;
            case 'ward':
                $data = $this->getWardList($request->input('query'));
                break;
            case 'division':
                $data = $this->getDivisionList($request->input('query'));
                break;
        }

        $items['suggestions'] = $data;
        return response()->json($items);
    }

    protected function getAttendingList($query)
    {
        return Attending::select('id as data', 'name as value')
                          ->where('name', 'like', $this->getSearchPattern($query))
                          ->get();
    }

    protected function getWardList($query)
    {
        return Ward::select('id as data', 'name as value')
                     ->where('name', 'like', $this->getSearchPattern($query))
                     ->get();
    }

    protected function getDivisionList($query)
    {
        return Division::select('id as data', 'name as value')
                         ->where('name', 'like', $this->getSearchPattern($query))
                         ->orWhere('name_eng', 'like', $this->getSearchPattern($query))
                         ->get();
    }

    protected function getSearchPattern($query)
    {
        $pattern = '%';
        for ($i=0; $i < strlen($query); $i++) {
            $pattern .= (mb_substr($query, $i, 1) . '%');
        }
        return $pattern;
    }
}
