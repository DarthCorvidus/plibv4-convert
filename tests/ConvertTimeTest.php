<?php
declare(strict_types=1);
namespace plibv4\convert;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssertTest
 *
 * @author hm
 */
final class ConvertTimeTest extends TestCase {
	function testSecondsToHms (): void {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::HMS);
		$this->assertEquals("03:25:41", $convert->convert("12341"));
	}
	
	function testNegativeSecondsToHms(): void {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::HMS);
		$this->assertEquals("-03:25:41", $convert->convert("-12341"));
	}

	function testSecondsToDecimal (): void {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::DECIMAL);
		$this->assertEquals("8.25", $convert->convert("29700"));
	}
	
	function testSecondsToSeconds(): void {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::SECONDS);
		$this->assertEquals("29700", $convert->convert("29700"));
	}
	
	function testHmsToSeconds(): void {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$this->assertEquals("12341", $convert->convert("03:25:41"));
	}

	function testNegativeHmsToSeconds(): void {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$this->assertEquals("-12341", $convert->convert("-03:25:41"));
	}
	
	function testHmsToDecimal(): void {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::DECIMAL);
		$this->assertEquals("8.5", $convert->convert("08:30:00"));
		
	}
	
	function testHmsToHms(): void {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::HMS);
		$this->assertEquals("08:30:00", $convert->convert("08:30:00"));
	}
	
	function testDecimalToHms(): void {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::HMS);
		$this->assertEquals("04:15:00", $convert->convert("4.25"));
	}

	function testNegativeDecimalToHms(): void {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::HMS);
		$this->assertEquals("-04:15:00", $convert->convert("-4.25"));
	}

	function testDecimalToSeconds(): void {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::SECONDS);
		$this->assertEquals("15300", $convert->convert("4.25"));
	}

	function testDecimalToSecondsInt(): void {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::SECONDS);
		$this->assertEquals("14400", $convert->convert("4"));
	}
	
	function testDecimalToDecimal(): void {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::DECIMAL);
		$this->assertEquals("4.25", $convert->convert("4.25"));
	}

}
