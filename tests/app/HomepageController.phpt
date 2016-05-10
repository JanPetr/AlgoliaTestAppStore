<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';
require __DIR__.'/../../app/Controllers/HomepageController.php';

class HomepageControllerTestCase extends Tester\TestCase
{
	/** @var HomepageController */
	private $homepageController;

	public function setUp()
	{
		$template = new \JanPetr\MVC\Template(__DIR__.'/../../app/Templates/Homepage.default.php');
		$response = new \JanPetr\MVC\Response();

		$this->homepageController = new HomepageController($template, $response);
	}

	public function testRunDefault()
	{
		$this->homepageController->runDefault();

		$template = $this->homepageController->getTemplate();

		Assert::type('\JanPetr\MVC\Template', $template);

		$output = $template->render();
		Assert::contains('<title>App Store | Algolia Test</title>', $output);
	}
}

$testCase = new HomepageControllerTestCase();
$testCase->run();