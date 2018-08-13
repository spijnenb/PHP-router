<?php

// todo: add send, render and redirect methods

class Response {
	public $test = "i'm a test";

	public function send($string) {
		print $string;
	}
	public function redirect($location) {
		header("Location: " . $location);
		exit;
	}
	public function render($location) {
		print "not set";
	}
}