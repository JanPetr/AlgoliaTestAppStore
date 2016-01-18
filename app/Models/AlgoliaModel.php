<?php

class AlgoliaModel
{
	private $client;

	public function addToIndex($indexName, $data)
	{
		$data = json_decode($data, TRUE);

		$index = $this->getClient()->initIndex($indexName);

		return $index->addObject($data);
	}

	public function deleteFromIndex($indexName, $objectID)
	{
		$index = $this->getClient()->initIndex($indexName);

		return $index->deleteObject($objectID);
	}

	public function getAppId()
	{
		return ALGOLIA_APP_ID;
	}

	public function getSearchOnlyApiKey()
	{
		return ALGOLIA_SEARCH_ONLY_API_KEY;
	}

	private function getClient()
	{
		if(!isset($this->client))
		{
			$this->client = new AlgoliaSearch\Client(ALGOLIA_APP_ID, ALGOLIA_ADMIN_API_KEY);
		}

		return $this->client;
	}
}