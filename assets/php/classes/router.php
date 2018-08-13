<?php

require_once(__DIR__ . "/request.php");
require_once(__DIR__ . "/response.php");

class Router {
	private $requestURL;
	private $requestType;

	public function __construct(){
		$url = explode('?',$_SERVER['REQUEST_URI'], 2);
		$this->requestURL = $url[0];
		$this->requestType = $_SERVER['REQUEST_METHOD'];
	}

	public function getName() {
		return "The request url is: " . $this->requestURL;
	}

	public function getType() {
		return "The type of request is " . $this->requestType;
	}

	public function get($url, $callback) {
		$request = $this->handleRequest("GET", $url);
		if (!$request) return;
		// callback with request parameters and request body
		$callback($request[0], $request[1]);
		exit;
	}

	public function post($url, $callback) {
		$request = $this->handleRequest("POST", $url);
		if (!$request) return;
		// callback with request parameters and request body
		$callback($request[0], $request[1]);
		exit;
	}

	public function put($url, $callback) {
		$request = $this->handleRequest("PUT", $url);
		if (!$request) return;
		// callback with request parameters and request body
		$callback($request[0], $request[1]);
		exit;
	}

	public function destroy($url, $callback) {
		$request = $this->handleRequest("DELETE", $url);
		if (!$request) return;
		// callback with request parameters and request body
		$callback($request[0], $request[1]);
		exit;
	}

	private function handleRequest ($type, $url) {
		if ($this->requestType !== $type) return false;
		// compare url and get request parameters
		$requestParams = $this->compareURL($url);
		if (!$requestParams) return false;
		// get request body
		$requestBody = @file_get_contents('php://input');
		// create request and response object
		$request = new Request($requestParams, $requestBody);
		$response = new Response();
		// return both objects
		$array = [$request, $response];
		return $array;
	}

	/**
	 * method compareURL
	 * 
	 * Compares the given url with the request URL of current request URL within Router.
	 * The GET URL contains wildcards called params which start with ':'
	 * If the URL's are equal, the params will be returned.
	 * If there are no params, a boolean value will be returned.
	 * 
	 * @param string GET URL: /dogs/:id
	 * @param string request URL: /dogs/bruno
	 * 
	 * @return array id1, id2 etc.
	 * @return string id1
	 * @return boolean if there are no params
	 */

	private function compareURL($getURL) {
		// trim last slash character
		$getURL = $this->trimLastSlash($getURL);
		$requestURL = $this->trimLastSlash($this->requestURL);

		// explode both URLs to arrays
		$keywordsGetURL = explode('/', $getURL);
		$keywordsRequestURL = explode('/', $requestURL);
		$params = [];
	
		if (count($keywordsGetURL) != count($keywordsRequestURL)) return false;

		for ($i = 0; $i < count($keywordsGetURL); $i++) {
			// if not an ID, compare
			if (substr($keywordsGetURL[$i], 0, 1) !== ':') {
				// if not equal, return false
				if ($keywordsGetURL[$i] !== $keywordsRequestURL[$i]) {
					return false;
				}
			} else {
				// store the ID in $params
				array_push($params, $keywordsRequestURL[$i]);
			}
		}

		// return values
		if (count($params) === 0) {
			return true;
		} else if (count($params) === 1) {
			return $params[0];
		} else {
			return $params;
		}
	}

	private function trimLastSlash($string) {
		$length = strlen($string);
		if ($string[$length - 1] === '/') {
			return substr($string, 0, $length - 1);
		} else {
			return $string;
		}
	}

	public function set404() {
		http_response_code(404);
		print "Not found";
		exit;
	}
}

?>