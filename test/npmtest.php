<?php

include '/usr/share/php/PHPUnit/Framework/TestCase.php';

include 'src/npm.php';

class npmtest extends PHPUnit\Framework\TestCase
{
	public function test1()
	{
		$npm = new Npm;

		$tree = [];
		$npm->npmdeps('chai','3.1.0',$tree);

		self::assertArrayHasKey('assertion-error',$tree);
		self::assertArrayNotHasKey('check-error',$tree);
		self::assertArrayHasKey('deep-eql',$tree);
		self::assertArrayHasKey('type-detect',$tree['deep-eql']['deps']);
	}
	
	public function test2()
	{
		$npm = new Npm;

		$tree = [];
		$npm->npmdeps('chai','latest',$tree);

		self::assertCount(6, $tree);
		self::assertArrayHasKey('assertion-error',$tree);
		self::assertArrayHasKey('check-error',$tree);
		self::assertArrayHasKey('deep-eql',$tree);
		self::assertArrayHasKey('type-detect',$tree['deep-eql']['deps']);
	}

	public function test3()
	{
		$npm = new Npm;

		$tree = [];
		$npm->npmdeps('express','4.16.4',$tree);

		self::assertCount(30, $tree);
		self::assertArrayHasKey('cookie',$tree);
		self::assertArrayHasKey('etag',$tree['send']['deps']);
		self::assertArrayHasKey('mime-db',$tree['accepts']['deps']['mime-types']['deps']);
		self::assertArrayHasKey('ee-first',$tree['finalhandler']['deps']['on-finished']['deps']);
	}
}

