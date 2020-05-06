<?php

namespace Interifcie\SpanishID\tests;

use Interficie\SpanishID\SpanishID;
use PHPUnit\Framework\TestCase;

class SpanishIDTest extends TestCase
{
    /**
     * @var SpanishID
     */
    private $spanishId;

    public function setUp(): void
    {
        $this->spanishId = new SpanishID();
    }

    public function test_valid_dni(): void
    {
        $this->assertTrue($this->spanishId->isValidNif('21361012S'));
        $this->assertTrue($this->spanishId->isValidNif('64160547T'));
        $this->assertTrue($this->spanishId->isValidNif('48692083W'));
        $this->assertTrue($this->spanishId->isValidNif('08861617Q'));
    }

    public function test_invalid_dni(): void
    {
        $this->assertFalse($this->spanishId->isValidNif('21361012'));
        $this->assertFalse($this->spanishId->isValidNif('1361012S'));
        $this->assertFalse($this->spanishId->isValidNif('12345678F'));
        $this->assertFalse($this->spanishId->isValidNif('008861617Q'));
        $this->assertFalse($this->spanishId->isValidNif(''));
        $this->assertFalse($this->spanishId->isValidNif('08861|617Q'));
    }

    public function test_valid_cif(): void
    {
        $this->assertTrue($this->spanishId->isValidCif('Q6887124C'));
        $this->assertTrue($this->spanishId->isValidCif('J51062271'));
        $this->assertTrue($this->spanishId->isValidCif('D9990690A'));
        $this->assertTrue($this->spanishId->isValidCif('N8796829C'));
    }

    public function test_invalid_cif(): void
    {
        $this->assertFalse($this->spanishId->isValidCif('Q6887124'));
        $this->assertFalse($this->spanishId->isValidCif('Q6887123C'));
        $this->assertFalse($this->spanishId->isValidCif('6887123C'));
        $this->assertFalse($this->spanishId->isValidCif(''));
        $this->assertFalse($this->spanishId->isValidCif('AAAAAAAAAAAAAAA'));
        $this->assertFalse($this->spanishId->isValidCif('Q6887|124C'));
    }

    public function test_valid_nie(): void
    {
        $this->assertTrue($this->spanishId->isValidNie('X3212050P'));
        $this->assertTrue($this->spanishId->isValidNie('X2792997S'));
    }


    public function test_invalid_nie(): void
    {
        $this->assertFalse($this->spanishId->isValidNie('Z8930474'));
        $this->assertFalse($this->spanishId->isValidNie('8930474Q'));
        $this->assertFalse($this->spanishId->isValidNie('Z893999Q'));
        $this->assertFalse($this->spanishId->isValidNie(''));
        $this->assertFalse($this->spanishId->isValidNie('X321|2050P'));
        $this->assertFalse($this->spanishId->isValidNie('08861617Q')); //nif
    }


    public function test_valid_nif(): void
    {
        $this->assertTrue($this->spanishId->isValidNif('21361012S'));
        $this->assertTrue($this->spanishId->isValidNif('Q6887124C'));
        $this->assertTrue($this->spanishId->isValidNif('X3212050P'));
    }

    public function test_invalid_nif(): void
    {
        $this->assertFalse($this->spanishId->isValidNif('Q6887124'));
        $this->assertFalse($this->spanishId->isValidNif('21361012'));
        $this->assertFalse($this->spanishId->isValidNif('Z893999Q'));
    }

    public function test_valid_nnss(): void
    {
        $this->assertTrue($this->spanishId->isValidNNSS('307365535155'));
        $this->assertTrue($this->spanishId->isValidNNSS('426999252649'));
    }

    public function test_invalid_nnss(): void
    {
        $this->assertFalse($this->spanishId->isValidNNSS('107819249351rtrtr'));
        $this->assertFalse($this->spanishId->isValidNNSS(''));
        $this->assertFalse($this->spanishId->isValidNNSS('426999II252649'));
        $this->assertFalse($this->spanishId->isValidNNSS('5453453245234532'));
        $this->assertFalse($this->spanishId->isValidNNSS('343465278753'));
    }



}