<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';
require __DIR__.'/../../app/Controllers/ApiController.php';

/**
 * @httpCode 500
 */
class ApiControllerTestCase extends Tester\TestCase
{
	/** @var  ApiController */
	private $apiAddToIndexController;

	/** @var  ApiController */
	private $deleteFromIndexController;

	public function setUp()
	{
		$template = new \JanPetr\MVC\Template(__DIR__.'/../../app/Templates/Api.addToIndex.php');
		$response = new \JanPetr\MVC\Response();

		$this->apiAddToIndexController = new ApiController($template, $response);

		$template = new \JanPetr\MVC\Template(__DIR__.'/../../app/Templates/Api.deleteFromIndex.php');
		$response = new \JanPetr\MVC\Response();

		$this->deleteFromIndexController = new ApiController($template, $response);
	}

	public function testRunAddToIndexFail()
	{
		$this->apiAddToIndexController->runAddToIndex('apps');

		$output = $this->apiAddToIndexController->getTemplate()->render();
		Assert::contains('{"status":"Error","message":"Error occured while adding object to Algolia', $output);

		ob_start();
		$this->apiAddToIndexController->getResponse()->send();
		ob_end_clean();

		$headers = headers_list();
		Assert::true(in_array('Content-Type: application/json', $headers, TRUE));
	}
}

$testCase = new ApiControllerTestCase();
$testCase->run();