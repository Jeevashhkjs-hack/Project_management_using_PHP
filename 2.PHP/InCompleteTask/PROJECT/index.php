<?php
require 'code/router.php';
session_start();
$router = new router();
unset($_SESSION['projectPage']);
// calling router function

$router->get('/','allProjects');
$router->get('/createProject','createProject');
$router->get('/insertProject','insertProject');
$router->post('/getTasks','getTasks');
$router->get('/taskView','taskView');
$router->post('/addTask','addTask');
$router->get('/undeletedTask','undeletedTask');
$router->get('/delete','delete');
$router->get('/deletedTask','deletedTask');

$router->routingFunc();