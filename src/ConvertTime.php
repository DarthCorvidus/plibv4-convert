<?php
/**
 * Time conversion class
 * 
 * @copyright (c) 2029, Claus-Christoph Küthe
 * @author Claus-Christoph Küthe <plibv4@vm01.telton.de>
 * @license LGPLv2.1
 */
namespace plibv4\convert;
/**
 * ConvertTime
 * 
 * Converts time from one format to another.
 * Supported formats are: 
 * 
 * * hh:mm:ss (ConvertTime::HMS) (leading zeroes, minutes and seconds optional)
 * * decimal (ConvertTime::DECIMAL) 
 * * seconds (ConvertTime::SECONDS)
 * 
 * Supports negative values such as -09:02:17.
 */
final class ConvertTime implements Convert {
	/** Time as seconds */
	const SECONDS = 0;
	/** Time as hh:mm:ss; incomplete values such as 08:53 or 08 allowed */
	const HMS = 1;
	/** Time as decimal (07:30 = 7.5) */
	const DECIMAL = 2;
	/** @var int $from Input format */
	private $from;
	/** @var int $to Output format */
	private $to;
	/**
	 * Constructs ConvertTime.
	 * @param int $from Input format
	 * @param int $to Output format
	 */
	function __construct(int $from, int $to) {
		$this->to = $to;
		$this->from = $from;
	}
	
	/**
	 * Converts input format to seconds.
	 * All values will be converted to seconds first.
	 * @param string $convertee input format
	 * @return int time as seconds
	 */
	private function toSeconds(string $convertee):int {
		if($this->from === self::SECONDS) {
			return (int)$convertee;
		}
		if($this->from === self::DECIMAL) {
			/**
			 * Only work with float if necessary.
			 */
			if(str_contains($convertee, ".")) {
				return (int)round((float)$convertee*3600.0);
			}
			$int = (int)$convertee;
			return $int*3600;
		}
		$factor = 1;
		$exp = explode(":", $convertee);
		if($exp[0]<0) {
			$factor = -1;
		}
		$seconds  = ((int)$exp[0]*3600)*$factor;
		if(isset($exp[1])) {
			$seconds += (int)$exp[1]*60;
		}
		if(isset($exp[2])) {
			$seconds += (int)$exp[2];
		}
	return $seconds*$factor;
	}
	
	/**
	 * Converts seconds to output format.
	 * Seconds will be converted to final format.
	 * @param int $seconds time as seconds
	 * @return string final output format
	 */
	private function toResult(int $seconds): string {
		if($this->to === self::SECONDS) {
			return (string)$seconds;
		}
		
		if($this->to === self::DECIMAL) {
			return (string)($seconds/3600);
		}
		$sign = "";
		/*
		 * Just treat negative values the same way as positive values, store
		 * sign for later use. 
		 */
		if($seconds<0) {
			$seconds = $seconds*-1;
			$sign = "-";
		}
		$hours = floor($seconds/3600);
		$remainder = $seconds%3600;
		$min = floor($remainder/60);
		$sec = $remainder%60;
	return sprintf("%s%02d:%02d:%02d", $sign, $hours, $min, $sec);
	}
	
	/**
	 * Converts one format to another or returns input value if target format
	 * is the same as the source format.
	 * @param string $convertee Input format
	 * @return string Output format
	 */
	#[\Override]
	public function convert(string $convertee): string {
		if($this->from === $this->to) {
			return $convertee;
		}
		$seconds = $this->toSeconds($convertee);
	return $this->toResult($seconds);
	}

}
