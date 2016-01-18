<?php

namespace JanPetr\MVC;

class Application
{
	/** @var Router */
	private $router;

	/** @var string */
	private $controllersDir = __DIR__.'/../app/Controllers/';

	/** @var string */
	private $templatesDir = __DIR__.'/../app/Templates/';

	/**
	 * @param Router $router
	 */
	public function __construct(Router $router)
	{
		$this->router = $router;
	}

	/**
	 * Dispatches a HTTP request to a front controller.
	 * Sends response to output.
	 *
	 * @return void
	 */
	public function run()
	{
		$request = $this->createRequest();
		$applicationRequestInformation = $this->router->match($request);

		$controllerName = $this->formatControllerName($applicationRequestInformation['controller']);
		$methodName = $this->formatMethodName($applicationRequestInformation['method']);
		$templateFileName = $this->formatTemplateFileName($applicationRequestInformation['controller'], $applicationRequestInformation['method']);

		require_once $this->controllersDir.$controllerName.'.php';

		$response = new Response();
		$template = new Template($this->templatesDir.$templateFileName);

		/** @var Controller $controller */
		$controller = new $controllerName($template, $response);

		if(method_exists($controller, $methodName))
		{
			call_user_func_array(array($controller, $methodName), $applicationRequestInformation['parameters']);
		}

		$response = $controller->getResponse();

		$response->setOutput($controller->getTemplate()->render());
		$response->send();
	}


	/**
	 * Sets directory where controllers are located
	 *
	 * @param string $controllersDir
	 */
	public function setControllersDir($controllersDir)
	{
		$this->controllersDir = $controllersDir;
	}

	/**
	 * Sets directory where templates are located
	 *
	 * @param string $templatesDir
	 */
	public function setTemplatesDir($templatesDir)
	{
		$this->templatesDir = $templatesDir;
	}

	/**
	 * Creates request object from HTTP request
	 *
	 * @return Request
	 */
	private function createRequest()
	{
		$path = $this->getRequestUri();
		return new Request($_SERVER['REQUEST_METHOD'], $path);
	}

	/**
	 * Gets requested URI
	 *
	 * @return string
	 */
	private function getRequestUri()
	{
		$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

		$scriptName = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
		$scriptName = mb_substr($scriptName, 0, -1);

		return str_replace($scriptName, '', $path);
	}

	/**
	 * @param string $controllerName
	 * @return string
	 */
	private function formatControllerName($controllerName)
	{
		return $controllerName.'Controller';
	}

	/**
	 * @param string $methodName
	 * @return string
	 */
	private function formatMethodName($methodName)
	{
		return 'run'.ucfirst($methodName);
	}

	/**
	 * @param string $controllerName
	 * @param string $methodName
	 * @return string
	 */
	private function formatTemplateFileName($controllerName, $methodName)
	{
		return $controllerName.'.'.$methodName.'.php';
	}
}