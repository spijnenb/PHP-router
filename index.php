<?php 

require("./assets/php/classes/router.php");

$router = new Router();

$router->get("/", function($req, $res){
	$res->send("Index Route");
});

$router->get("/demo", function($req, $res){
	$res->render("demo.html");
});

$router->set404();

?>