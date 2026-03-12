<?php
require_once '../app/core/Router.php';

use App\Core\Router;

$router = new Router();

// Register Routes

// Landing Page
$router->add("GET", "/", "LandingController", "landingView");


// Login
$router->add("GET", "/login", "AuthController", "loginView");

// Register
$router->add("GET", "/register", "AuthController", "registerView");



$router->run();

?>