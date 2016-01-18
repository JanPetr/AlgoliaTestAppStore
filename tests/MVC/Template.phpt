<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';

class TemplateTestCase extends Tester\TestCase
{
	public function testTemplate()
	{
		$templateFile = __DIR__.'/testFiles/Test.template.php';

		$template = new JanPetr\MVC\Template($templateFile);
		$template->foo = 'bar';

		Assert::same('bar', $template->render());
	}
}

$testCase = new TemplateTestCase();
$testCase->run();