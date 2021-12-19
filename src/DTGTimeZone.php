<?php
declare(strict_types=1);

namespace Spirit55555\DTG;

enum DTGTimeZone : string {
	use DTGEnum;

	case Z = 'UTC';

	case A = '+1';
	case B = '+2';
	case C = '+3';
	case D = '+4';
	case E = '+5';
	case F = '+6';
	case G = '+7';
	case H = '+8';
	case I = '+9';
	case K = '+10';
	case L = '+11';
	case M = '+12';

	case N = '-1';
	case O = '-2';
	case P = '-3';
	case Q = '-4';
	case R = '-5';
	case S = '-6';
	case T = '-7';
	case U = '-8';
	case V = '-9';
	case W = '-10';
	case X = '-11';
	case Y = '-12';

	public static function fromUnixOffset(int $offset) : self {
		if ($offset === 0)
			return self::Z;

		//We round it down because of weird timezones.
		$timezone = floor($offset / 3600);

		if ($timezone > 0)
			$timezone = '+'.$timezone;

		return self::from((string) $timezone);
	}

	private static function getDefault() : self {
		return self::Z;
	}
}
?>
