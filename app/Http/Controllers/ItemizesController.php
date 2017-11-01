<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemizesController extends Controller
{
	public function getAttendingList($term) {
		$keys = explode('|',$term);
		$key = $keys[0];
		$term = $keys[1];
		if ($key == 'med')
			$idStart = 200; // medicine.
		// $items = DB::table('attending_staffs')
		// 			->join('title','attending_staffs.title_id','=','title.id')
		// 			->join('division','attending_staffs.division_id','=','division.id')
	 //                ->select(DB::raw("attending_staffs.id, CONCAT(title.name,attending_staffs.name,' @ ',division.name_eng_short) as attending"))
	 //                ->where('attending_staffs.division_id','>=',100)
	 //                ->where('attending_staffs.division_id','<',200)
	 //    			->get();

		// $items  = DB::select("SELECT * FROM (
		// 						SELECT attending_staffs.id AS value, CONCAT(attending_staffs.name,' @ ',division.name_eng_short, ' ว. ',attending_staffs.licence_no) AS label, attending_staffs.name AS name
		// 						FROM attending_staffs 
		// 						INNER JOIN division
		// 						on attending_staffs.division_id = division.id
		// 						WHERE (attending_staffs.division_id >= " . $idStart . " AND attending_staffs.division_id < " . ($idStart + 100) . ")
		// 						) AS a
		// 						WHERE label LIKE '%" . $term . "%'"
		// 					);

		$items  = DB::select("SELECT * FROM (
								SELECT attending_staffs.id AS value, CONCAT(attending_staffs.name,' @ ',division.name_eng_short, ' ว. ',attending_staffs.licence_no) AS label, attending_staffs.name AS name
								FROM attending_staffs 
								INNER JOIN division
								on attending_staffs.division_id = division.id
								) AS a
								WHERE label LIKE '%" . $term . "%'"
							);
		return $items;
	} // get attending list by depaertment and search term.

	public function getWardList($term) {
		$keys = explode('|',$term);
		$key = $keys[0];
		$term = $keys[1];
		if ($key == 'med')
			$idStart = 200; // medicine.
		
		$items	= DB::select(
								"SELECT * 
								FROM (
								SELECT wards.id AS value, CONCAT(wards.name_short,' | ',wards.name) AS label, wards.name AS name
								FROM wards 
								) AS a
								WHERE label LIKE '%" . $term . "%'"		
							);
		return $items;
	} // get ward list by depaertment and search term.

	public function getDivisionList($term) {
		$keys = explode('|',$term);
		$key = $keys[0];
		$term = $keys[1];
		if ($key == 'med')
			$idStart = 200; // medicine.
		
		$items	= DB::select(
								"SELECT * 
								FROM (
								SELECT division.id AS value, CONCAT(division.name_eng_short,' | ', division.name_eng, ' | ', division.name) AS label, division.name_eng_short AS division_name
								FROM division 
								) AS a
								WHERE label LIKE '%" . $term . "%'"		
							);
		return $items;
	} // get ward list by depaertment and search term.

	public function getDrugList($term) {
		$items = DB::table('drugs')->select('id as value','name as label')->where('key','like','%' . $term . '%')->orderBy('name')->get();
		return $items;
	} // get drug list by search term.
}
