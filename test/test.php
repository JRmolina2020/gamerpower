<?php

use PHPUnit\Framework\TestCase;
require_once'calculadora.php';

final class Testcalculadora extends TestCase
{
	
	public function testSuma(){
		$calcu= NEW Calculadora();
		$this->assertEquals(8, $calcu->sumar(4,4));
	}
}


?>