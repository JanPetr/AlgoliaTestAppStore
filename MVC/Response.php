<?php

namespace JanPetr\MVC;


class Response
{
	/** @var string */
	private $contentType;

	/** @var int */
	private $code = 200;

	/** @var string */
	private $output = '';

	/**
	 * Sets output string which should be sent out
	 *
	 * @param string $output
	 */
	public function setOutput($output)
	{
		$this->output = $output;
	}

	/**
	 * Sets the content type of output
	 *
	 * @param string $contentType
	 */
	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
	}

	/**
	 * Sets HTTP code of output
	 *
	 * @param int $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}

	/**
	 * Sends output with the right content type
	 *
	 * @return void
	 */
	public function send()
	{
		http_response_code($this->code);
		if(isset($this->contentType))
		{
			header('Content-Type: '.$this->contentType);
		}

		echo $this->output;
	}
}