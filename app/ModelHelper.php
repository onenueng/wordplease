<?php

namespace App;

use Crypt\Crypt;
use Carbon\Carbon;

class ModelHelper
{
	/**
	* Encypt data.
	* @param string $value.
	* @return string.
	**/
	public static function encryptData($value) {
		return ($value == '') ? NUll : \Crypt::encrypt($value);
	}

	/**
	* Decypt data.
	* @param string $value.
	* @return string.
	**/
	public static function decryptData($value) {
		return is_null($value) ? NULL : \Crypt::decrypt($value);
	}

	/**
	* Parse THAI datetime format to database datetime format.
	* @param string $value.
	* @return string.
	**/
	public static function parseDateTimeData($value) {
		return $value == '' ? NULL : Carbon::createFromFormat('d-m-Y H:i', $value);
	}

	/**
	* Parse THAI date format to database date format.
	* @param string $value.
	* @return string.
	**/
	public static function parseDateData($value) {
		return $value == '' ? NULL : Carbon::createFromFormat('d-m-Y', $value);
	}

	/**
	* check numeric data or null.
	* @param string $value.
	* @return string or null.
	*/
	public static function setNumericData($value){
		return is_numeric($value) ? $value : NULL;
	}

	public static function getCat($str, $mode = 'AN') {
		// // random key.
		// $key = env('APP_KEY');
		// $randomKey = '';
		// for($i = 1; $i <= 4; $i++){
		// 	$randomKey .= $key[rand(0, (strlen($key) - 1))];
		// }
		// $str = (string)$str;
		// $base = '';
		// for ($i = strlen($str) - 1; $i >= 0; $i--)
		// 	$base .= ord($str[$i]);
		// if ($mode == 'AN')
		// 	return 	$randomKey . 
		// 					substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR8')), -2, 1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR6')), -2, 1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR2')), -1);
		
		// return 	substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR6')), -2, 1) . 
		// 				substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR8')), -2, 1) . 
		// 				substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR2')), -1) . 
		// 				substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
		// 				$randomKey;

		$str = (string)$str;
		$base = '';
		for ($i = strlen($str) - 1; $i >= 0; $i--)
			$base .= ord($str[$i]);
		if ($mode == 'AN')
			return 	substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR6')), -2, 1) . 
							substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR8')), -2, 1) . 
							substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR2')), -1) . 
							substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
							substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR8')), -2, 1) . 
							substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR6')), -2, 1) . 
							substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
							substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR2')), -1);
		
		return 	substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR8')), -2, 1) . 
						substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR6')), -2, 1) . 
						substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
						substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR2')), -1) . 
						substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR6')), -2, 1) . 
						substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR8')), -2, 1) . 
						substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR2')), -1) . 
						substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1);

		// $str = (string)$str;
		// $base = '';
		// for ($i = strlen($str) - 1; $i >= 0; $i--)
		// 	$base .= ord($str[$i]);
		// if ($mode == 'AN') {
		// 	$str = 	substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR6')), -2, 1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR8')), -2, 1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR2')), -1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR1'), env('CAT_FACTOR8')), -2, 1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR6')), -2, 1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR5'), env('CAT_FACTOR4')), -1) . 
		// 					substr(base_convert($base, env('CAT_FACTOR7'), env('CAT_FACTOR2')), -1);
		// 	if (strlen($str) < 8)
		// 		return str_pad($str, 8, env('CAT_FACTOR9'), STR_PAD_BOTH);
		// 	return $str;
		// }
		// $str = base_convert($base, env('CAT_FACTOR3'), env('CAT_FACTOR4'));
		// if (strlen($str) < 8)
		// 	return str_pad($str, 8, env('CAT_FACTOR6'), STR_PAD_BOTH);
		// return $str;
	} 
}
