<?php

require __DIR__.'/../Models/AlgoliaModel.php';

class ApiController extends JanPetr\MVC\Controller
{
	private $algoliaModel;

	public function runAddToIndex($indexName)
	{
		$data = file_get_contents('php://input');

		try
		{
			$result = $this->getAlgoliaModel()->addToIndex($indexName, $data);

			$data = array(
				'status' => 'OK',
				'objectID' => $result['objectID'],
			);
		}
		catch(AlgoliaSearch\AlgoliaException $e)
		{
			$this->response->setCode(500);
			$data = array(
				'status' => 'Error',
				'message' => 'Error occured while adding object to Algolia index. Error message from Algolia: '.$e->getMessage(),
			);
		}

		$this->response->setContentType('application/json');
		$this->template->result = json_encode($data);
	}

	public function runDeleteFromIndex($indexName, $id)
	{
		try
		{
			$this->getAlgoliaModel()->deleteFromIndex($indexName, $id);
			$data = array(
				'status' => 'OK',
			);

		}
		catch(AlgoliaSearch\AlgoliaException $e)
		{
			$this->response->setCode(500);
			$data = array(
				'status' => 'Error',
				'message' => 'Error occured while deleting object from Algolia index. Error message from Algolia: '.$e->getMessage(),
			);
		}

		$this->response->setContentType('application/json');
		$this->template->result = json_encode($data);
	}

	/** @return AlgoliaModel */
	private function getAlgoliaModel()
	{
		if(!isset($this->algoliaModel))
		{
			$this->algoliaModel = new AlgoliaModel();
		}

		return $this->algoliaModel;
	}
}