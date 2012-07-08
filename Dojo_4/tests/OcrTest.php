<?php

require_once dirname(__FILE__) . '/../Ocr.php';

/**
 * Test class for Ocr.
 * Generated by PHPUnit on 2012-07-07 at 18:41:03.
 */
class OcrTest extends PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Ocr::getNumbers
     */
    public function testGetNumbers() {
        $ocr = new Ocr('../arquivos_entrada/entrada_.txt');

        $actual = $ocr->getNumbers();

        $expected = array();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Ocr::getNumbers
     */
    public function testGetNumbers_111111111() {
        $ocr = new Ocr('../arquivos_entrada/entrada_111111111.txt');

        $actual = $ocr->getNumbers();

        $expected = array('111111111');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Ocr::getNumbers
     */
    public function testGetNumbers_111111111_111111111() {
        $ocr = new Ocr('../arquivos_entrada/entrada_111111111_111111111.txt');

        $actual = $ocr->getNumbers();

        $expected = array('111111111', '111111111');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Ocr::getNumbers
     */
    public function testGetNumbers_123456789_012345678() {
        $ocr = new Ocr('../arquivos_entrada/entrada_123456789_012345678.txt');

        $actual = $ocr->getNumbers();

        $expected = array('123456789', '012345678');

        $this->assertEquals($expected, $actual);
    }
}
