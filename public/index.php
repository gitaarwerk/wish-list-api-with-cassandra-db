<?php

require_once 'startup.php';


use Wishlist\Connector as Connector;
use Wishlist\Core as Core;
use Wishlist\Util as Util;
use Wishlist\Exceptions as Exceptions;

$db = new Connector\CassandraConnector();
$db->connect();

$determineContentType = new Util\DetermineContentType();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {
    $router->addRoute(['GET', 'POST'], '/wishlist/byUserId/{identityRoleId:\d+}', '\Wishlist\Controller\Wishlist');
    $router->addRoute(['DELETE'], '/wishlist/{wishlistName}/byUserId/{identityRoleId:\d+}/product/{productId:\d+}', '\Wishlist\Controller\Wishlist');
});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
            new Exceptions\NotFound("Location not found");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        new Exceptions\NotFound("Method not allowed. Allowed methods are: " . implode(",", $allowedMethods));
        break;
    case FastRoute\Dispatcher::FOUND:
        $vars = $routeInfo[2];
        $constructionOptions = array_merge($vars, array("db" => $db->getDatabase()));

        /** @var Wishlist\Interfaces\Methods $controller */
        $controller = new $routeInfo[1]($constructionOptions);

        new Core\ControllerExecutioner($controller);

        break;
}

$output =  Core\ResponseHeader::getOutput();
echo $output;