<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';

/**
 * @httpCode 404
 */
class RouterTestCase extends Tester\TestCase
{
	/** @var JanPetr\MVC\Router */
	private $router;

	public function setUp()
	{
		$this->router = new JanPetr\MVC\Router();
		$this->router->addRoute('GET', '/', array(
			'controller' => 'Homepage',
			'method' => 'default',
		));

		$this->router->addRoute('POST', '/api/1/:index', array(
			'controller' => 'Api',
			'method' => 'addToIndex',
		));

		$this->router->addRoute('DELETE', '/api/1/:index/:id', array(
			'controller' => 'Api',
			'method' => 'removeFromIndex',
		));
	}

	public function tearDown()
	{
		unset($this->router);
	}

	public function testGet()
	{
		$request = new JanPetr\MVC\Request('GET', '/');

		$appRequestInformation = $this->router->match($request);
		Assert::same('Homepage', $appRequestInformation['controller']);
		Assert::same('default', $appRequestInformation['method']);
		Assert::same(array(), $appRequestInformation['parameters']);
	}

	public function testPost()
	{
		$request = new JanPetr\MVC\Request('POST', '/api/1/apps');

		$appRequestInformation = $this->router->match($request);
		Assert::same('Api', $appRequestInformation['controller']);
		Assert::same('addToIndex', $appRequestInformation['method']);
		Assert::same(array(1 => 'apps'), $appRequestInformation['parameters']);
	}

	public function testDelete()
	{
		$request = new JanPetr\MVC\Request('DELETE', '/api/1/apps/15');

		$appRequestInformation = $this->router->match($request);
		Assert::same('Api', $appRequestInformation['controller']);
		Assert::same('removeFromIndex', $appRequestInformation['method']);
		Assert::same(array(1 => 'apps', 2 => '15'), $appRequestInformation['parameters']);
	}

	/**
	 * @throws \JanPetr\MVC\NoRouteFound
	 */
	public function testNonExistingRoute()
	{
		$request = new JanPetr\MVC\Request('GET', '/api/1/apps');
		$this->router->match($request);
	}
}

$testCase = new RouterTestCase();
$testCase->run();