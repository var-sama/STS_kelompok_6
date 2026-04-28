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

$router->add("GET", "/problem-detail", "ProblemDetailController", "detailView");
// Register
$router->add("GET", "/Problemcreate", "ProblemController", "ProblemcreateView");
// Analytics
$router->add("GET", "/analytics", "AnalyticsController", "analyticsView");
// Analytics
$router->add("GET", "/tags", "ProblemController", "TagsView");




$router->run();

?>