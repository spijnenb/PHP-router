<?php 

require("./assets/php/classes/router.php");
require("./assets/php/classes/response.php");

$router = new Router();
$res = new Response();

$router->get("/elements", function(){
	print "You have reached elements";
});
$router->post("/elements", function($id, $body){
	print "You have posted something to elements\n";
	print "and the body is " . $body;
});
$router->get("/cookies/:id", function(){
	print "this should an ID";
});

$router->get("/dogs/:id/", function($requestID, $body){
	print "You have reached the dogs route and submitted id: " . $requestID;
});

$router->post("/dogs/:id", function($requestID, $body){
	print "you have reached the dogs POST route with id " . $requestID . "\n";
	print_r($body);
});

$router->destroy("/killme", function(){
	print "assassination succesfull";
});
$router->put("/tester", function(){
	print "reached put route";
});

$router->get("/cats", function(){
	// do something
});

$router->set404();

?>