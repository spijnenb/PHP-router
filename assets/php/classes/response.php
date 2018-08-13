<?php

// todo: add send, render and redirect methods

class Response {

	public function send($string) {
		print $string;
		exit;
	}
	public function redirect($location) {
		header("Location: " . $location);
		exit;
	}
	public function render($page) {
		// try to find file
		try {
			$path = $_SERVER["DOCUMENT_ROOT"] . "/views/" . $page;
			if (!file_exists($path)) {
				throw new Exception("Page not found in file directory.");
			} else {
				require($path);
			}
		}
		catch (Exception $exception) {
			print "Page failed to render:\n";
			print $exception->getMessage();
		}
		exit;
	}
}