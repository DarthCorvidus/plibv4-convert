<?php
/**
 * Interface to convert one format into another.
 * 
 * The idea of Convert is to convert user input or other sources from one format
 * into another.
 * @author Claus-Christoph Küthe
 * @copyright (c) 2020, Claus-Christoph Küthe
 */
interface Convert {
	/**
	 * Convert string from one format to another.
	 * 
	 * @param string $convertee string to be converted
	 */
	public function convert(string $convertee): string;
}
