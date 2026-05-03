<?php
require_once '../app/core/Router.php';

use App\Core\Router;

$router = new Router();

// Register Routes

// Landing Page
$router->add("GET", "/", "LandingController", "landingView");
$router->add("GET", "/landing", "LandingController", "landingView");

// Login
$router->add("GET", "/login", "AuthController", "loginView");
$router->add("POST", "/login", "AuthController", "loginView");

// Register
$router->add("GET", "/register", "AuthController", "registerView");
$router->add("POST", "/register", "AuthController", "registerView");

$router->add("GET", "/problem-detail", "ProblemDetailController", "detailView");
$router->add("GET", "/detail", "ProblemDetailController", "detailView");
// Register
$router->add("GET", "/Problemcreate", "ProblemController", "ProblemcreateView");
// Analytics
$router->add("GET", "/analytics", "AnalyticsController", "analyticsView");
$router->add("GET", "/teams", "LandingController", "teamsView");
$router->add("GET", "/teams-detail", "LandingController", "teamsDetailView");
$router->add("GET", "/teams-create", "LandingController", "teamsCreateView");



$router->run();

?>