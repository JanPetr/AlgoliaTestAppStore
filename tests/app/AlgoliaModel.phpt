<?php

use Tester\Assert;

require __DIR__.'/../bootstrap.php';
require_once __DIR__.'/../../app/Models/AlgoliaModel.php';

class AlgoliaModelTestCase extends Tester\TestCase
{
	/** @var AlgoliaModel */
	private $algoliaModel;

	public function setUp()
	{
		$this->algoliaModel = new AlgoliaModel();
	}

	public function tearDown()
	{
		unset($this->algoliaModel);
	}

	public function testGetters()
	{
		Assert::same(ALGOLIA_APP_ID, $this->algoliaModel->getAppId());
		Assert::same(ALGOLIA_SEARCH_ONLY_API_KEY, $this->algoliaModel->getSearchOnlyApiKey());
	}

	/**
	 * @throws AlgoliaSearch\AlgoliaException
	 */
	public function testAddToIndexFail()
	{
		$this->algoliaModel->addToIndex('apps', '');
	}

	public function testAddToIndexSuccess()
	{
		$addResult = $this->algoliaModel->addToIndex('apps_test', '{
			"name": "Testing app",
			"image": "image-url",
			"link": "app-link",
			"category": "Test",
			"rank": 80
		}');

		Assert::true(isset($addResult['objectID']));

		$deleteResult = $this->algoliaModel->deleteFromIndex('apps_test', $addResult['objectID']);

		Assert::true(isset($deleteResult['objectID']));
		Assert::equal($addResult['objectID'], $deleteResult['objectID']);
	}
}

$testCase = new AlgoliaModelTestCase();
$testCase->run();