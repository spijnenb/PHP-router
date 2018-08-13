<?php

class Request {
	private $parameters;
	private $body;

	public function __construct($parameters, $body) {
		$this->parameters = $parameters;
		$this->body = $body;
	}

	public function getParams() {
		return $this->parameters;
	}

	public function getBody() {
		return $this->body;
	}
}

?>