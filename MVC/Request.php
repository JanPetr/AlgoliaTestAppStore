<?php

namespace JanPetr\MVC;

class Request
{
	/** @var string */
	private $method;

	/** @var string */
	private $url;

	/**
	 * @param $method
	 * @param $url
	 */
	public function __construct($method, $url)
	{
		$this->method = mb_strtoupper($method);
		$this->url = $url;
	}

	/**
	 * Gets HTTP request method
	 *
	 * @return string
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Gets requested URL
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}
}