<?php

namespace App\Http\Requests\IPDNote\Obgyn;

use App\Http\Requests\Request;

class EditObgynNoteRequest extends Request
{

	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize() {
		return TRUE;
	}

	/**
	* Get the validation rules that apply to the request.
	* Cannot use unique in database on encrypted fields.
	* @return array
	*/
	public function rules() {
		switch ($this->note_type_id) {
		case 2: // delivery.
			return [
				'G' => 'required|integer|between:0,255',
				'P' => 'required|integer|between:0,255',
				'A' => 'required|integer|between:0,255',
				'GA_weeks' => 'required|integer|between:0,255',
				'GA_days' => 'required|integer|between:0,6',
				'apgar_1min_born_no_1' => 'required|integer|between:0,10',
				'apgar_5min_born_no_1' => 'required|integer|between:0,10',
				'apgar_1min_born_no_2' => 'integer|between:0,10',
				'apgar_5min_born_no_2' => 'integer|between:0,10',
				'apgar_1min_born_no_3' => 'integer|between:0,10',
				'apgar_5min_born_no_3' => 'integer|between:0,10',
				'apgar_1min_born_no_4' => 'integer|between:0,10',
				'apgar_5min_born_no_4' => 'integer|between:0,10',
				'apgar_1min_born_no_5' => 'integer|between:0,10',
				'apgar_5min_born_no_5' => 'integer|between:0,10',
				'third_stage_labour_complication_EBL_ml' => 'integer|between:0,65535',
				'multiple_born_number' => 'integer|between:0,255',
				'weight_grams_born_no_1' => 'integer|between:0,65535',
				'weight_grams_born_no_2' => 'integer|between:0,65535',
				'weight_grams_born_no_3' => 'integer|between:0,65535',
				'weight_grams_born_no_4' => 'integer|between:0,65535',
				'weight_grams_born_no_5' => 'integer|between:0,65535',
				'placenta_weight_grams_1' => 'integer|between:0,65535',
				'placenta_weight_grams_2' => 'integer|between:0,65535',
				'placenta_weight_grams_3' => 'integer|between:0,65535',
				'placenta_weight_grams_4' => 'integer|between:0,65535',
				'placenta_weight_grams_5' => 'integer|between:0,65535',
			];
			
		case 3: // newborn.
			return [
				'born_oder' => 'integer|between:0,255',
				'apgar_1min' => 'integer|between:0,10',
				'apgar_5min' => 'integer|between:0,10',
				'G' => 'integer|between:0,255',
				'P' => 'integer|between:0,255',
				'GA_weeks' => 'integer|between:0,255',
				'GA_days' => 'integer|between:0,6',
				'weight_grams' => 'integer|between:0,65535',
				'placenta_weight_grams' => 'integer|between:0,65535',
			];
		case 4: // undelivery.
			return [
				'G' => 'integer|between:0,255',
				'P' => 'integer|between:0,255',
				'A' => 'integer|between:0,255',
				'GA_weeks' => 'integer|between:0,255',
				'GA_days' => 'integer|between:0,6',
				'PCR' => 'integer|between:0,255',
			];
		case 5: // abortation.
			return [
				'G' => 'integer|between:0,255',
				'P' => 'integer|between:0,255',
				'A' => 'integer|between:0,255',
				'GA_weeks' => 'integer|between:0,255',
				'GA_days' => 'integer|between:0,6',
				'quantity_tea_spoon' => 'integer|between:0,255',
				'quantity_table_spoon' => 'integer|between:0,255',
				'fetus_weight_grams' => 'integer|between:0,65535',
				'fetus_EBL_ml' => 'integer|between:0,65535',
				'placenta_weight_grams' => 'integer|between:0,65535',
				'product_weight_grams' => 'integer|between:0,65535',
				'conception_EBL_ml' => 'integer|between:0,65535',
			];
		default:
			return [];
		}
	}

	/**
	* Get the error messages for the defined validation rules.
	*
	* @return array
	*/
	public function messages() {
		switch ($this->note_type_id) {
		case 2: // delivery.
			return [
				'G.required' => 'G| - |จำเป็นต้องลงข้อมูลนี้|G',
				'G.integer' => 'G| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|G',
				'G.between' => 'G| - |รับค่าได้ระหว่าง 0 ถึง 255 เท่านั้น|G',

				'P.required' => 'P| - |จำเป็นต้องลงข้อมูลนี้|P',
				'P.integer' => 'P| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|P',
				'P.between' => 'P| - |รับค่าได้ระหว่าง 0 ถึง 255 เท่านั้น|P',

				'A.required' => 'A| - |จำเป็นต้องลงข้อมูลนี้|A',
				'A.integer' => 'A| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|A',
				'A.between' => 'A| - |รับค่าได้ระหว่าง 0 ถึง 255 เท่านั้น|A',
			
				'GA_weeks.required' => 'GA Weeks| - |จำเป็นต้องลงข้อมูลนี้|GA_weeks',
				'GA_weeks.integer' => 'GA Weeks| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|GA_weeks',
				'GA_weeks.between' => 'GA Weeks| - |รับค่าได้ระหว่าง 0 ถึง 255 เท่านั้น|GA_weeks',

				'GA_days.required' => 'GA Days| - |จำเป็นต้องลงข้อมูลนี้|GA_days',
				'GA_days.integer' => 'GA Days| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|GA_days',
				'GA_days.between' => 'GA Days| - |รับค่าได้ระหว่าง 0 ถึง 6 เท่านั้น|GA_days',

				'apgar_1min_born_no_1.required' => 'APGAR Score 1 minute #1| - |จำเป็นต้องลงข้อมูลนี้|apgar_1min_born_no_1',
				'apgar_1min_born_no_1.integer' => 'APGAR Score 1 minute #1| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|apgar_1min_born_no_1',
				'apgar_1min_born_no_1.between' => 'APGAR Score 1 minute #1| - |รับค่าได้ระหว่าง 0 ถึง 10 เท่านั้น|apgar_1min_born_no_1',

				'apgar_5min_born_no_1.required' => 'APGAR Score 5 minutes #1| - |จำเป็นต้องลงข้อมูลนี้|apgar_5min_born_no_1',
				'apgar_5min_born_no_1.integer' => 'APGAR Score 5 minutes #1| - |ต้องเป็นเลขจำนวนเต็มเท่านั้น|apgar_5min_born_no_1',
				'apgar_5min_born_no_1.between' => 'APGAR Score 5 minutes #1| - |รับค่าได้ระหว่าง 0 ถึง 10 เท่านั้น|apgar_5min_born_no_1',
			];
		default:
			return [];
		}
	}

	/**
	* Get the error messages for the defined validation rules.
	* Cannot use unique in database on encrypted fields.
	* @return array
	*/
	// public function messages() {
	// 	return [
	// 		'AN.required' => 'จำเป็นต้องใส่ AN',
	// 		'AN.digits' => 'AN ต้องเป็นเลข 8 หลัก',
	// 	];
	// }

	// public function getNumericInputs() {
	// 	return [
	// 		'G',
	// 		'P',
	// 		'A',
	// 		'GA_weeks',
	// 		'GA_days',
	// 		'apgar_1min_born_no_1',
	// 		'apgar_5min_born_no_1',
	// 		'apgar_1min_born_no_2',
	// 		'apgar_5min_born_no_2',
	// 		'apgar_1min_born_no_3',
	// 		'apgar_5min_born_no_3',
	// 		'apgar_1min_born_no_4',
	// 		'apgar_5min_born_no_4',
	// 		'apgar_1min_born_no_5',
	// 		'apgar_5min_born_no_5',
	// 		'third_stage_labour_complication_EBL_ml',
	// 		'multiple_born_number',
	// 		'weight_grams_born_no_1',
	// 		'weight_grams_born_no_2',
	// 		'weight_grams_born_no_3',
	// 		'weight_grams_born_no_4',
	// 		'weight_grams_born_no_5',
	// 		'placenta_weight_grams_1',
	// 		'placenta_weight_grams_2',
	// 		'placenta_weight_grams_3',
	// 		'placenta_weight_grams_4',
	// 		'placenta_weight_grams_5',
	// 	];
	// }
}