<?php
declare(strict_types=1);
namespace plibv4\convert;
use PHPUnit\Framework\TestCase;
/**
 * @copyright (c) 2021, Claus-Christoph Küthe
 * @author Claus-Christoph Küthe <floss@vm01.telton.de>
 * @license LGPL
 */

/**
 * ConvertTrailingSlashTest
 * 
 * Unit Test for ConvertTrailingSlash.
 */
class ConvertTrailingSlashTest extends TestCase {
	/**
	 * Remove Slash
	 * 
	 * Remove trailing slash from path.
	 */
	function testRemoveSlash() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::REMOVE);
		$convertee = "/mnt/usb-drive/";
		$target = "/mnt/usb-drive";
		$this->assertEquals($target, $convert->convert($convertee));
	}
	
	/**
	 * Remove slashes
	 * 
	 * Remove several trailing slashes from path.
	 */
	function testRemoveSlashes() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::REMOVE);
		$convertee = "/mnt/usb-drive////";
		$target = "/mnt/usb-drive";
		$this->assertEquals($target, $convert->convert($convertee));
	}

	/**
	 * Ignore Non Existing
	 * 
	 * Do not harm, insult, maim, kill or negatively impact paths in any way
	 * that do not have a trailing slash.
	 */
	function testIgnoreNonExisting() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::REMOVE);
		$convertee = "/mnt/usb-drive";
		$target = "/mnt/usb-drive";
		$this->assertEquals($target, $convert->convert($convertee));
	}
	
	/**
	 * Remove root
	 * 
	 * Turn a single slash into an empty string.
	 */
	function testRemoveRoot() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::REMOVE);
		$convertee = "/";
		$target = "";
		$this->assertEquals($target, $convert->convert($convertee));
	}

	/**
	 * Add Slash
	 * 
	 * Add trailing slash if none exists.
	 */
	function testAddSlash() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::ADD);
		$convertee = "/mnt/usb-drive";
		$target = "/mnt/usb-drive/";
		$this->assertEquals($target, $convert->convert($convertee));
	}

	/**
	 * Add Slash If Exists
	 * 
	 * Do nothing.
	 */
	function testAddSlashIfExists() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::ADD);
		$convertee = "/mnt/usb-drive/";
		$target = "/mnt/usb-drive/";
		$this->assertEquals($target, $convert->convert($convertee));
	}

	/**
	 * Add Slash if Several exist
	 * 
	 * Actually remove unnecessary slashes.
	 */
	function testAddSlashIfSeveralExist() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::ADD);
		$convertee = "/mnt/usb-drive//";
		$target = "/mnt/usb-drive/";
		$this->assertEquals($target, $convert->convert($convertee));
	}
	
	/**
	 * Add Root
	 * 
	 * Turn an empty string into a single slash.
	 */
	function testAddRoot() {
		$convert = new ConvertTrailingSlash(ConvertTrailingSlash::ADD);
		$convertee = "";
		$target = "/";
		$this->assertEquals($target, $convert->convert($convertee));
	}

}