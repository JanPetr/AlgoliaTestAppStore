<?php

require __DIR__.'/../Models/AlgoliaModel.php';

class HomepageController extends JanPetr\MVC\Controller
{
	public function runDefault()
	{
		$algoliaModel = new AlgoliaModel();

		$this->template->appId = $algoliaModel->getAppId();
		$this->template->searchOnlyApiKey = $algoliaModel->getSearchOnlyApiKey();
	}
}