<?php
/**
 * Converts date from one format to another.
 *
 * @author Claus-Christoph Küthe
 * @copyright (c) 2020, Claus-Christoph Küthe
 */
class ConvertDate implements Convert {
	/** ISO 8601 compliant date (YYYY-MM-DD) */
	const ISO = 1;
	/** DIN 5800 compliant date (prior to adoption of ISO 8601, DD.MM.YYYY) */
	const GERMAN = 2;
	/** US compliant date (MM/DD/YYYY) */
	const US = 3;
	/**
	 * @var int format to convert from
	 */
	private $from;
	/**
	 * @var int format to convert to
	 */
	private $to;
	/**
	 * Constructs ConvertDate.
	 * @param int $from source format
	 * @param int $to target format
	 * @throws InvalidArgumentException if to or from are not a class constant
	 */
	function __construct(int $from, int $to) {
		Assert::isClassConstant(get_class(), $to, "to");
		Assert::isClassConstant(get_class(), $from, "from");
		$this->to = $to;
		$this->from = $from;
	}
	
	private function validConstant(int $constant, string $name) {
		if(!in_array($constant, array(self::ISO, self::GERMAN, self::US))) {
			throw new InvalidArgumentException($constant." is not an expected value for \$".$name);
		}
	}
	
	/**
	 * Transforms string into array.
	 * Array contains three entries year, month, day.
	 * @param int $from source format
	 * @param string $convertee date as string in source format
	 * @return array year, month, day
	 */
	static function toArray(int $from, string $convertee): array {
		Assert::isClassConstant(get_class(), $from, "from");
		if($from==self::ISO) {
			return explode("-", $convertee);
		}
		if($from==self::GERMAN) {
			$exp = explode(".", $convertee);
		return array($exp[2], $exp[1], $exp[0]);
		}
		if($from==self::US) {
			$exp = explode("/", $convertee);
		return array($exp[2], $exp[0], $exp[1]);
		}
	}

	/**
	 * Converts array to target format.
	 * Takes array containing year, month, day and returns target format. Please
	 * note that target format will always have leading zeroes where applicable.
	 * @param int $to target format.
	 * @param array $iso array containing year, month, day.
	 * @return string date formatted as target format.
	 */
	static function toResult(int $to, array $iso): string {
		Assert::isClassConstant(get_class(), $to, "to");
		if($to==self::ISO) {
			return sprintf("%d-%02d-%02d", $iso[0], $iso[1], $iso[2]);
		}
		
		if($to==self::GERMAN) {
			return sprintf("%02d.%02d.%d", $iso[2], $iso[1], $iso[0]);
		}

		if($to==self::US) {
			return sprintf("%02d/%02d/%d", $iso[1], $iso[2], $iso[0]);
		}

	}

	/**
	 * Converts string containing source format to target format.
	 * @param string $convertee source format.
	 * @return string target format.
	 */
	public function convert(string $convertee): string {
		$iso = $this->toArray($this->from, $convertee);
	return $this->toResult($this->to, $iso);
	}

}