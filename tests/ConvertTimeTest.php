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
class ConvertTimeTest extends TestCase {
	function testToSecondsHms() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toSeconds");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array("03:25:41"));
		$this->assertEquals(12341, $result);
	}

	function testToSecondsHmsNoSeconds() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toSeconds");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array("03:25"));
		$this->assertEquals(12300, $result);
	}

	function testToSecondsHmsOnlyHours() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toSeconds");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array("03"));
		$this->assertEquals(10800, $result);
	}

	
	function testToSecondsHmsNegative() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toSeconds");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array("-03:25:41"));
		$this->assertEquals(-12341, $result);
	}
	
	function testToSecondsDecimal() {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::SECONDS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toSeconds");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array("8.25"));
		$this->assertEquals(29700, $result);
	}

	function testToResultDecimal() {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::DECIMAL);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toResult");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array(29700));
		$this->assertEquals("8.25", $result);
	}
	
	function testToResultHms() {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::HMS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toResult");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array(12341));
		$this->assertEquals("03:25:41", $result);
	}

	function testToResultHmsNegative() {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::HMS);
		$reflector = new ReflectionClass(ConvertTime::class);
		$method = $reflector->getMethod("toResult");
		$method->setAccessible(true);
		$result = $method->invokeArgs($convert, array(-12341));
		$this->assertEquals("-03:25:41", $result);
	}
	

	function testSecondsToHms () {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::HMS);
		$this->assertEquals("03:25:41", $convert->convert("12341"));
	}
	
	function testNegativeSecondsToHms() {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::HMS);
		$this->assertEquals("-03:25:41", $convert->convert("-12341"));
	}

	function testSecondsToDecimal () {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::DECIMAL);
		$this->assertEquals("8.25", $convert->convert("29700"));
	}
	
	function testSecondsToSeconds() {
		$convert = new ConvertTime(ConvertTime::SECONDS, ConvertTime::SECONDS);
		$this->assertEquals("29700", $convert->convert("29700"));
	}
	
	function testHmsToSeconds() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$this->assertEquals("12341", $convert->convert("03:25:41"));
	}

	function testNegativeHmsToSeconds() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::SECONDS);
		$this->assertEquals("-12341", $convert->convert("-03:25:41"));
	}
	
	function testHmsToDecimal() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::DECIMAL);
		$this->assertEquals("8.5", $convert->convert("08:30:00"));
		
	}
	
	function testHmsToHms() {
		$convert = new ConvertTime(ConvertTime::HMS, ConvertTime::HMS);
		$this->assertEquals("08:30:00", $convert->convert("08:30:00"));
	}
	
	function testDecimalToHms() {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::HMS);
		$this->assertEquals("04:15:00", $convert->convert("4.25"));
	}
	
	function testNegativeDecimalToHms() {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::HMS);
		$this->assertEquals("-04:15:00", $convert->convert("-4.25"));
	}

	function testDecimalToSeconds() {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::SECONDS);
		$this->assertEquals("15300", $convert->convert("4.25"));
	}
	
	function testDecimalToDecimal() {
		$convert = new ConvertTime(ConvertTime::DECIMAL, ConvertTime::DECIMAL);
		$this->assertEquals("4.25", $convert->convert("4.25"));
	}

}
