<?php

namespace PhpKnight\WeMeal;

class Helper {

	/**
	 * Format price with currency symbol
	 *
	 * @param $price
	 * @param int $decimal
	 * @param string $decimal_separator
	 * @param string $thousand_separator
	 *
	 * @return string
	 */
	public static function format_price( $price, int $decimal = 2, string $decimal_separator = '.', string $thousand_separator = ',' ): string {
		$price = floatval( $price );
		return '&#2547;' . number_format( $price, $decimal, $decimal_separator, $thousand_separator );
	}

}
