<?php

namespace JanPetr\MVC;

class Controller
{
	/** @var Template */
	protected $template;

	/** @var Response */
	protected $response;

	/**
	 * Creates and injects required dependencies to controller
	 *
	 * @param Template $template
	 * @param Response $response
	 */
	public function __construct(Template $template, Response $response)
	{
		$this->template = $template;
		$this->response = $response;
	}

	/**
	 * @return Template
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * @return Response
	 */
	public function getResponse()
	{
		return $this->response;
	}
}