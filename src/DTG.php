<?php
declare(strict_types=1);

namespace Spirit55555\DTG;

class DTG {
	private \DateTime $date_time;
	private DTGFormat $format;

	public function __construct(mixed $time = 'now', mixed $timezone = null, DTGFormat $format = DTGFormat::NORMAL_HUMAN) {
		//FIXME: Support parsing of DTG.
		if ($time instanceof \DateTime)
			$this->date_time = $time;
		else
			$this->date_time = new \DateTime($time);

		if (isset($timezone))
			$this->setTimezone($timezone);

		$this->format = $format;
	}

	public function __toString() : string {
		return $this->format();
	}

	public function __get($name) : string {
		return $this->format(DTGFormat::fromName($name));
	}

	public function __call($name, $args) : self {
		return new DTG($this->date_time, null, DTGFormat::fromName($name));
	}

	public function getFormat() : DTGFormat {
		return $this->format;
	}

	public function setFormat(DTGFormat $format) : self {
		$this->format = $format;
		return $this;
	}

	public function getTimeZone() : DTGTimeZone {
		$timezone_offset = $this->date_time->getOffset();
		return DTGTimeZone::fromUnixOffset($timezone_offset);
	}

	public function setTimeZone(mixed $timezone) : self {
		if ($timezone instanceof DTGTimeZone)
			$this->date_time->setTimeZone(new \DateTimeZone($timezone->value));
		else
			$this->date_time->setTimeZone(new \DateTimeZone($timezone));

		return $this;
	}

	private function format(DTGFormat $override_format = null) : string {
		$format = isset($override_format) ? $override_format->value : $this->format->value;

		$dtg = $this->date_time->format($format);
		$timezone_offset = $this->date_time->getOffset();
		$dtg = str_replace('{x}', DTGTimeZone::fromUnixOffset($timezone_offset)->name, $dtg);

		return strtoupper($dtg);
	}
}
?>
