<?php
declare(strict_types=1);
namespace plibv4\convert;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
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
final class ConvertDateTest extends TestCase {
	function testConstructInvalidFromFormat(): void {
		$this->expectException(InvalidArgumentException::class);
		new ConvertDate(15, ConvertTime::HMS);
	}
	function testConstructInvalidToFormat(): void {
		$this->expectException(InvalidArgumentException::class);
		new ConvertDate(ConvertTime::HMS, 15);
	}

	function testToArrayFromIso(): void {
		$this->assertEquals(array("2020", "07", "05"), ConvertDate::toArray(ConvertDate::ISO, "2020-07-05"));
	}

	function testToArrayFromGerman(): void {
		$this->assertEquals(array("2020", "07", "05"), ConvertDate::toArray(ConvertDate::GERMAN, "05.07.2020"));
	}

	function testToArrayFromUs(): void {
		$this->assertEquals(array("2020", "07", "05"), ConvertDate::toArray(ConvertDate::US, "07/05/2020"));
	}
	
	function testToResultIso(): void {
		$this->assertEquals("2020-07-05", ConvertDate::toResult(ConvertDate::ISO, array("2020", "07", "05")));
	}

	function testToResultGerman(): void {
		$this->assertEquals("05.07.2020", ConvertDate::toResult(ConvertDate::GERMAN, array("2020", "07", "05")));
	}

	function testToResultUs(): void {
		$this->assertEquals("07/05/2020", ConvertDate::toResult(ConvertDate::US, array("2020", "07", "05")));
	}
	
	function testIsoToIso(): void {
		$convert = new ConvertDate(ConvertDate::ISO, ConvertDate::ISO);
		$this->assertEquals("2020-07-05", $convert->convert("2020-07-05"));
	}

	function testIsoToGerman(): void {
		$convert = new ConvertDate(ConvertDate::ISO, ConvertDate::GERMAN);
		$this->assertEquals("05.07.2020", $convert->convert("2020-07-05"));
	}
	
	function testIsoToUs(): void {
		$convert = new ConvertDate(ConvertDate::ISO, ConvertDate::US);
		$this->assertEquals("07/05/2020", $convert->convert("2020-07-05"));
	}
	
	function testGermanToIso(): void {
		$convert = new ConvertDate(ConvertDate::GERMAN, ConvertDate::ISO);
		$this->assertEquals("2020-07-05", $convert->convert("05.07.2020"));
	}

	function testGermanToGerman(): void {
		$convert = new ConvertDate(ConvertDate::GERMAN, ConvertDate::GERMAN);
		$this->assertEquals("05.07.2020", $convert->convert("05.07.2020"));
	}

	function testGermanToUs(): void {
		$convert = new ConvertDate(ConvertDate::GERMAN, ConvertDate::US);
		$this->assertEquals("07/05/2020", $convert->convert("05.07.2020"));
	}

	function testUsToIso(): void {
		$convert = new ConvertDate(ConvertDate::US, ConvertDate::ISO);
		$this->assertEquals("2020-07-05", $convert->convert("07/05/2020"));
	}

	function testUsToGerman(): void {
		$convert = new ConvertDate(ConvertDate::US, ConvertDate::GERMAN);
		$this->assertEquals("05.07.2020", $convert->convert("07/05/2020"));
	}

	function testUsToUs(): void {
		$convert = new ConvertDate(ConvertDate::US, ConvertDate::US);
		$this->assertEquals("07/05/2020", $convert->convert("07/05/2020"));
	}

}
