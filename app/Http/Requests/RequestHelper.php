<?php

namespace App\Http\Requests;

class RequestHelper {
	/**
	* Fill attributes those exclude $request becasue of uncheck-checkbox.
	*
	* @return by referance.
	*/
	public static function radioCheckInputComplement(&$request, &$model) {
		// checkbox.
		$checkInputs = $model->getCheckInputs();
		for ($i = 0; $i < count($checkInputs); $i++) {
			if (!array_key_exists($checkInputs[$i], $request)) {
				$request[$checkInputs[$i]] = "0";	
			} else {
				$request[$checkInputs[$i]] = "1";	
			}
		}

		// radio.
		$radioInputs = $model->getRadioInputs();
		for ($i = 0; $i < count($radioInputs); $i++) {
			if (!array_key_exists($radioInputs[$i], $request)) {
			$request[$radioInputs[$i]] = NULL;	
			}
		}
	}

	public static function setNullToEmptyTextInput(&$request, &$model) {
		$textInputs = $model->getTextInputs();
		for ($i = 0; $i < count($textInputs); $i++) {
			if ($request[$textInputs[$i]] === '')
				$request[$textInputs[$i]] = NULL;
		}
	}

	public static function setNullToEmptyNumericInput(&$request, &$model) {
		$numericInputs = $model->getNumericInputs();
		for ($i = 0; $i < count($numericInputs); $i++) {
			if (!is_numeric($request[$numericInputs[$i]]))
				$request[$numericInputs[$i]] = NULL;
		}
	}

	public function checkAllInputs(&$request, &$model) {
		// checkbox.
		$checkInputs = $model->getCheckInputs();
		for ($i = 0; $i < count($checkInputs); $i++) {
			if (!array_key_exists($checkInputs[$i], $request)) {
				$request[$checkInputs[$i]] = "0";	
			} else {
				$request[$checkInputs[$i]] = "1";	
			}
		}

		// radio.
		$radioInputs = $model->getRadioInputs();
		for ($i = 0; $i < count($radioInputs); $i++) {
			if (!array_key_exists($radioInputs[$i], $request)) {
			$request[$radioInputs[$i]] = NULL;	
			}
		}

		$textInputs = $model->getTextInputs();
		for ($i = 0; $i < count($textInputs); $i++) {
			if ($request[$textInputs[$i]] === '')
				$request[$textInputs[$i]] = NULL;
		}

		$numericInputs = $model->getNumericInputs();
		for ($i = 0; $i < count($numericInputs); $i++) {
			if (!is_numeric($request[$numericInputs[$i]]))
				$request[$numericInputs[$i]] = NULL;
		}
	}

	/**
	* Format error with link to control that produce error.
	* @return string.
	*/
	public static function formatError($error) {
		$parts = explode("|", $error);
		if (count($parts) > 1) {        
			$format = "<strong>" . $parts[0] ."</strong>" . $parts[1];
			$format .= "<a href='#" . $parts[3] ."' style='color: #AA3939;text-decoration: underline;'>" . $parts[2] ."</a>";
			return $format;
		} else {
			return $error;
		}
	}
}