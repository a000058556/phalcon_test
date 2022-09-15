<?php

$router = $di->getRouter();

// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);

// 設定初始路由
// $router->setDefaultController('test'); 
// return $router;
