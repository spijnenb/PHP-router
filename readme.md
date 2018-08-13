# PHP-router

Implements basic routing for the seven RESTful routes: Index, New, Create, Show, Edit, Update and Destroy. Works similar to Node Express. Only a subset of requests are supported.

## Geting Started

- Make sure a recent version of PHP is installed (7.2.x)
- Extract files to folder
- Start a PHP CLI webserver with the following command
```
php -S localhost:3000
```

## Example code

### Listen to requests

```
require("./assets/php/classes/router.php");
$router = new Router();

// add routes here

// returns 404 message
$router->set404();
```

### GET request

```
$router->get("/", function($request, $response){
	$response->send("hello world");
});
```

### GET request with dynamic URL

```
$router->get("/catalog/:item", function($req, $res){
	$item = $req->getParams();
	$res->send("Did you look for " . $item . "?");
});
```

```
$router->get("/:customer/:item", function($req, $res){
	// multiple parameters are returned in an array
	$params = $req->getParams();
	$customer = $params[0];
	$item = $params[1];
	$res->send("Hello " . $customer . ", here is the item you want: " . $item);
});
```

### POST request and render page

```
$router->post("/example", function($request, $response){
	$body = $request->getBody();
	$response->render("demo.php", $body);
});
```

### Destroy request and redirect

```
$router->delete("/blogs/:id", function($request, $response){
	$id = $request->getParams();
	// add logic to delete $id
	$response->redirect("/some-other-url");
});
```

## License

This project is licensed under the MIT License - see the LICENSE.md file for details