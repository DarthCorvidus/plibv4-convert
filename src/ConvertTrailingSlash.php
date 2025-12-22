<?php
/**
 * Add or remove trailing slashes
 * 
 * @copyright (c) 2021, Claus-Christoph Küthe
 * @author Claus-Christoph Küthe <floss@vm01.telton.de>
 * @license LGPL
 */

/**
 * ConvertTrailingSlash
 * 
 * Paths like /mnt/usb-drive//final/ do not look nice, and paths like
 * /mnt/usb-drivefinal are not nice either ;-). ConvertTrailingSlash removes
 * or adds trailing slashes from/to paths.
 */
final class ConvertTrailingSlash implements Convert {
	const REMOVE = 1;
	const ADD = 2;
	/**
	 * 
	 * @var int contains desired format
	 */
	private $format;
	/**
	 * Construct with format, defaults to self::REMOVE.
	 * @param int $format add or remove slashes.
	 * @throws InvalidArgumentException Thrown if $format is not ConvertTrailingSlash::ADD or ConvertTrailingSlash::REMOVE
	 */
	function __construct(int $format = self::REMOVE) {
		Assert::isEnum($format, array(self::REMOVE, self::ADD));
		$this->format = $format;
	}
	
	/**
	 * convertRemove
	 * 
	 * Removes trailing slashes.
	 * @param string $convertee
	 * @return string
	 */
	private function convertRemove(string $convertee): string {
		$matches = array();
		preg_match("/^(.*)\/*$/U", $convertee, $matches);
	return $matches[1];
	}

	/**
	 * Convert
	 * 
	 * Convert function as such. If ADD is used, first slashes will be removed
	 * and one will be added.
	 * @param string $convertee
	 * @return string
	 */
	#[\Override]
	function convert(string $convertee): string {
		if($this->format===self::REMOVE) {
			return $this->convertRemove($convertee);
		}
		if($this->format===self::ADD) {
			return $this->convertRemove($convertee)."/";
		}
	// should not happen.
	throw new \RuntimeException("invalid format");
	}
}
