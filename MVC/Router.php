<?php

namespace JanPetr\MVC;

class Router
{
	/**
	 * List of defined routes
	 *
	 * @var array
	 */
	private $routes;

	/**
	 * Add new route to routes list
	 *
	 * @param string $method
	 * @param string $routePattern
	 * @param array $settings
	 */
	public function addRoute($method, $routePattern, $settings)
	{
		$method = mb_strtoupper($method);
		$this->routes[$method][$routePattern] = $settings;
	}

	/**
	 * Matches Request to one of defined routes
	 *
	 * @param Request $request
	 * @return array
	 * @throws NoRouteFound
	 */
	public function match(Request $request)
	{
		$method = $request->getMethod();

		if(isset($this->routes[$method]))
		{
			foreach((array) $this->routes[$method] as $routePattern => $routeSettings)
			{
				if($this->matchRoute($request->getUrl(), $routePattern, $routeSettings) === TRUE)
				{
					return $routeSettings;
				}
			}
		}

		http_response_code(404);
		throw new NoRouteFound('No routed found for method "'.$method.'" and URL "'.$request->getUrl().'"');
	}

	/**
	 * Decides if request matches the route
	 *
	 * @param string $requestUrl
	 * @param string $routePattern
	 * @param array $routeSettings
	 * @return bool
	 */
	private function matchRoute($requestUrl, $routePattern, &$routeSettings)
	{
		$routePattern = $this->prepareRoutePattern($routePattern);

		if(preg_match($routePattern, $requestUrl, $regs))
		{
			unset($regs[0]);
			$routeSettings['parameters'] = $regs;

			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Prepares route regular expression pattern
	 *
	 * @param string $routePattern
	 * @return string
	 */
	private function prepareRoutePattern($routePattern)
	{
		$patternParts = explode('/', $routePattern);
		foreach($patternParts as $partIndex => $patternPart)
		{
			if(strncmp($patternPart, ':', 1) === 0)
			{
				$patternParts[$partIndex] = '(.+)';
			}
		}

		$routePattern = '@^'.implode('/', $patternParts).'$@';

		return $routePattern;
	}
}