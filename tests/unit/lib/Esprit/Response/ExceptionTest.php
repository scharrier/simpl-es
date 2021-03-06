<?php
namespace Esprit\Response ;

class ExceptionTest extends \PHPUnit_Framework_TestCase {

	public function testUsage() {
		// String
		$exception = new \Esprit\Response\Exception('Test string message') ;
		$this->assertEquals($exception->getMessage(), $exception->error) ;

		// Array
		$exception = new \Esprit\Response\Exception(array('error' => 'Test array message')) ;
		$this->assertEquals('Test array message', $exception->error) ;

		// Array
		$exception = new \Esprit\Response\Exception(array('badkey' => 'Test array message')) ;
		$this->assertEquals('An error has occured but cannot be decoded', $exception->error) ;
		$this->assertEquals('Test array message', $exception->badkey) ;
	}
}
