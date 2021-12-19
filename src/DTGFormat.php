<?php
declare(strict_types=1);

namespace Spirit55555\DTG;

//{x} is the timezone identifier
enum DTGFormat : string {
	use DTGEnum;

	//No spaces
	case SHORT = 'dHi{x}';
	case NORMAL = 'dHi{x}My';
	case FULL = 'dHis{x}My';

	//More human readable, with spaces
	case SHORT_HUMAN = 'dHi {x}';
	case NORMAL_HUMAN = 'dHi {x} M y';
	case FULL_HUMAN = 'dHis {x} M y';

	private static function getDefault() : self {
		return self::FULL_HUMAN;
	}
}
?>
