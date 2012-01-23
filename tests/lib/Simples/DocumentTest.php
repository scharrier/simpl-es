<?php
require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'bootstrap.php') ;

class Simples_DocumentTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * Set up some fixtures. 
	 */
	public function setUp() {
		$this->data['standard'] = array(
			'firstname' => 'Jim',
			'lastname' => 'Morrison',
			'categories' => array('Poet','Composer'),
			'band' => array(
				'name' => 'The doors'
			),
			'friends' => array(
				array('firstname' => 'Ray' , 'lastname' => 'Manzarek'),
				array('firstname' => 'Robbie' , 'lastname' => 'Krieger'),
				array('firstname' => 'John' , 'lastname' => 'Densmore')
			)
		) ;
		
		$this->data['source'] = array(
			'_index' => 'music',
			'_type' => 'artists',
			'_source' => array(
				'firstname' => 'Jim',
				'lastName' => 'Morrisson'
			)
		);
	}
	
	public function testConstruct() {
		$request = new Simples_Document() ;
		$this->assertTrue($request instanceof Simples_Document) ;
	}
	
	public function testAccessors() {
		$document = new Simples_Document($this->data['standard']) ;
		
		$this->assertEquals('Jim', $document->firstname);
		$this->assertTrue($document->band instanceof Simples_Document) ;
		$this->assertTrue($document->categories instanceof Simples_Document) ;
		$this->assertTrue($document->friends instanceof Simples_Document_Set) ;
		$this->assertNull($document->properties()) ;
		
		$document = new Simples_Document($this->data['source']) ;
		$this->assertEquals('Jim', $document->firstname);
		$this->assertEquals('music', $document->properties()->index) ;
	}
	
	public function testToArray() {
		$document = new Simples_Document($this->data['standard']) ;
		$res = $document->to('array') ;
		$this->assertEquals('Jim', $res['firstname']) ;
		
		$document = new Simples_Document($this->data['source']) ;
		$res = $document->to('array') ;
		$this->assertEquals('Jim', $res['_source']['firstname']) ;
		$this->assertEquals('music', $res['_index']) ;
	}
}