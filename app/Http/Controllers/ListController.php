<?php

namespace App\Http\Controllers;

use App\Models\Lists\AttendingStaff;
use App\Models\Lists\Division;
use App\Models\Lists\Drug;
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
                $data = AttendingStaff::getList($request->input('query'));
                break;
            case 'ward':
                $data = Ward::getList($request->input('query'));
                break;
            case 'division':
                $data = Division::getList($request->input('query'));
                break;
            case 'drug':
                $data = Drug::getList($request->input('query'));
                break;
        }

        $items['suggestions'] = $data;
        return response()->json($items);
    }
}
