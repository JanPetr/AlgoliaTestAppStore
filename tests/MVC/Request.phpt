<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';

class RequestTestCase extends Tester\TestCase
{
	public function testRequest()
	{
		$request = new JanPetr\MVC\Request('geT', '/api/1');

		Assert::same('GET', $request->getMethod());
		Assert::same('/api/1', $request->getUrl());

		Assert::notSame('geT', $request->getMethod());
		Assert::notSame('/api/1/', $request->getUrl());
	}
}

$testCase = new RequestTestCase();
$testCase->run();