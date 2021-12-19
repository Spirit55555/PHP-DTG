<?php
declare(strict_types=1);

namespace Spirit55555\DTG;

trait DTGEnum {
	public static function fromName($name) : self {
		$case = strtoupper($name);

		$reflection = new \ReflectionEnum(self::class);

		if ($reflection->hasCase($case))
			return $reflection->getCase($case)->getValue();
		else
			return self::getDefault();
	}

	abstract private static function getDefault();
}
?>
