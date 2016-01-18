<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';

/**
 * @httpCode 404
 */
class ResponseTestCase extends Tester\TestCase
{
	/** @var JanPetr\MVC\Response */
	private $response;

	public function setUp()
	{
		$this->response = new JanPetr\MVC\Response();
	}

	public function tearDown()
	{
		unset($this->response);
	}

	public function testEmptyResponse()
	{
		ob_start();
		$this->response->send();
		$output = ob_get_clean();

		Assert::same('', $output);
	}

	public function testFilledResponse()
	{
		$expectedOutput = 'Hello from response';
		$this->response->setOutput($expectedOutput);

		ob_start();
		$this->response->send();
		$output = ob_get_clean();

		Assert::same($expectedOutput, $output);
	}

	public function testContentType()
	{
		$contentType = 'application/json';
		$this->response->setContentType($contentType);

		ob_start();
		$this->response->send();
		ob_end_clean();

		$headers = headers_list();
		Assert::true(in_array('Content-Type: application/json', $headers, TRUE));
	}

	public function testCode()
	{
		$this->response->setCode(404);

		ob_start();
		$this->response->send();
		ob_end_clean();

		// No assert is needed. Expected code is in class annotation.
	}
}

$testCase = new ResponseTestCase();
$testCase->run();