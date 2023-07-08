<?php
/**
 * Convert Interface
 * 
 * The Interface can be used to demand an implementation of convert, in order to
 * write more generic code when using Convert.
 * @copyright (c) 2029, Claus-Christoph Küthe
 * @author Claus-Christoph Küthe <plibv4@vm01.telton.de>
 * @license LGPLv2.1
 */

/**
 * Convert
 * 
 * The idea of Convert is to convert user input or other sources from one format
 * into another.
 */
interface Convert {
	/**
	 * Convert string from one format to another.
	 * 
	 * @param string $convertee string to be converted
	 */
	public function convert(string $convertee): string;
}
