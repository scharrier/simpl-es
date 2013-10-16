<?php
namespace Simples\Test\Request ;

class Delete extends \PHPUnit_Framework_TestCase {

	public function testDelete() {
		$client = new \Simples\Transport\Http();
		$this->assertTrue($client->index(
			array(
				'content' => 'Pliz, pliz, delete me !'
			),
			array(
				'index' => 'twitter',
				'type' => 'tweet',
				'id' => 'test_get'
			))->ok);

		$delete_object = $client->delete(1, array(
			'index' => 'twitter',
			'type' => 'tweet',
		)) ;
		$this->assertEquals('/twitter/tweet/1/', (string) $delete_object->path()) ;

		$this->assertEquals(true, $delete_object->ok) ;
		$res = $client->get(1, array(
			'index' => 'twitter',
			'type' => 'tweet',
		)) ;
		$this->assertFalse($res->exists);
	}
}
