<?php

namespace App\Traits;

trait DateTimeConversion {

	/**
	 * Converts a formatted date string into another date string in a different format
	 *
	 * @param $dateAsString string with the formatted date
	 * @param $inputFormat format of the input date
	 * @param $outputFormat format to convert the date
	 * @return A date formatted string	 
	 */
	private function formatDateString($dateAsString, $inputFormat, $outputFormat) {
		return \DateTime::createFromFormat($inputFormat, $dateAsString)->format($outputFormat);
	}

}