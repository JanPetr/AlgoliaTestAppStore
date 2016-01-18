<?php

namespace JanPetr\MVC;

class Template
{
	/**
	 * Path of template file
	 * @var string
	 */
	private $file;

	/**
	 * @param string $file
	 */
	public function __construct($file)
	{
		$this->file = $file;
	}

	/**
	 * Renders template
	 *
	 * @return string
	 */
	public function render()
	{
		ob_start();

		foreach($this as $variableName => $variableValue)
		{
			$$variableName = $variableValue;
		}

		include $this->file;

		return ob_get_clean();
	}
}