<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';

class ControllerTestCase extends Tester\TestCase
{
	public function testController()
	{
		$template = $this->prepareTemplate();
		$response = new JanPetr\MVC\Response();

		$controller = new \JanPetr\MVC\Controller($template, $response);

		Assert::same($template, $controller->getTemplate());
		Assert::same($response, $controller->getResponse());
		Assert::same('bar', $template->render());
	}

	private function prepareTemplate()
	{
		$templateFile = TEMP_DIR.'/testTemplate.php';
		file_put_contents($templateFile, '<?php echo $foo; ');

		$template = new JanPetr\MVC\Template($templateFile);
		$template->foo = 'bar';

		return $template;
	}
}

$testCase = new ControllerTestCase();
$testCase->run();