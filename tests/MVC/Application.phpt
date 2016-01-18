<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';

/**
 * @httpCode 404
 */
class ApplicationTestCase extends Tester\TestCase
{
	public function testSuccessRunMethod()
	{
		$expectedOutput = '24';

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/algolia_test/www/test/template/'.$expectedOutput;
		$_SERVER['SCRIPT_NAME'] = '/algolia_test/www/index.php';

		$router = $this->prepareRouter();
		$application = new JanPetr\MVC\Application($router);

		$application->setControllersDir(__DIR__.'/testFiles/');
		$application->setTemplatesDir(__DIR__.'/testFiles/');

		ob_start();
		$application->run();
		$applicationOutput = ob_get_clean();

		Assert::same($expectedOutput, $applicationOutput);
	}

	/**
	 * @throws \JanPetr\MVC\NoRouteFound
	 */
	public function testFailRunMethod()
	{
		$expectedOutput = '24';

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/algolia_test/www/testtt/template/'.$expectedOutput;
		$_SERVER['SCRIPT_NAME'] = '/algolia_test/www/index.php';

		$router = $this->prepareRouter();
		$application = new JanPetr\MVC\Application($router);

		$application->setControllersDir(__DIR__.'/testFiles/');
		$application->setTemplatesDir(__DIR__.'/testFiles/');

		ob_start();
		$application->run();
		$applicationOutput = ob_get_clean();

		Assert::same($expectedOutput, $applicationOutput);
	}

	private function prepareRouter()
	{
		$router = new JanPetr\MVC\Router();
		$router->addRoute('GET', '/test/template/:id', array(
			'controller' => 'Test',
			'method' => 'template',
		));

		return $router;
	}
}

$testCase = new ApplicationTestCase();
$testCase->run();