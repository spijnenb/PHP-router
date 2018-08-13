<?php 

require("./assets/php/classes/router.php");

$router = new Router();

$router->get("/demo", function($req, $res){
	$res->render("demo.html");
});

$router->post("/apples/:tree/:brand", function($req, $res){
	$params = $req->getParams();
	$body = $req->getBody();
	$res->send(
		"You have reached the apples POST route. Your tree is "
		. $params[0] . " and your brand is " . $params[1] . "\n" .
		"You have submitted the following data: " . $body
	);
});

$router->set404();

?>