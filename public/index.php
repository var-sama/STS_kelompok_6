<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

$router->add("GET", "/problem-detail", "LandingController", "detailView");
$router->add("GET", "/detail", "ProblemDetailController", "detailView");
$router->add("POST", "/add-comment", "LandingController", "postComment");

// Tambahkan ini di index.php bersama rute lainnya
$router->add("POST", "/toggle-bookmark", "LandingController", "toggleBookmark");
$router->add("GET", "/bookmark", "LandingController", "bookmarkView");
// Register
$router->add("GET", "/Problemcreate", "ProblemController", "ProblemcreateView");
$router->add("POST", "/Problemcreate", "ProblemController", "store");
// Analytics
$router->add("GET", "/analytics", "AnalyticsController", "analyticsView");
$router->add("GET", "/teams", "LandingController", "teamsView");
$router->add("GET", "/teams-detail", "LandingController", "teamsDetailView");
$router->add("GET", "/teams-create", "LandingController", "teamsCreateView");
$router->add("POST", "/teams-store", "LandingController", "storeTeam");
$router->add('DELETE', '/teams/{id}', 'TeamController', 'delete');
// Analytics
$router->add("GET", "/tags", "ProblemController", "TagsView");
// Profile
$router->add("GET", "/profile", "profileController", "profileView");



$router->add("GET", "/dashboard", "DashboardController", "dashboardView");




$router->run();

?>