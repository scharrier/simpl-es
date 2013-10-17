<?php
namespace Simples\Request ;

class StatusTest extends \PHPUnit_Framework_TestCase {

   public function testStatus() {
	   $client = new \Simples\Transport\Http() ;
	   $results = $client->status()->execute() ;
	   $this->assertEquals(true, $results->ok) ;
	   $this->assertTrue(isset($results->_shards->total)) ;
   }
}
