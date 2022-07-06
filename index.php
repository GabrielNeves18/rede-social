<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/system/config.php";

$app = new \Slim\App();


//homecontroller - GET 
$app->get('/', '\rede\Controllers\HomeController:login');
$app->get('/feed', '\rede\Controllers\HomeController:feed');
$app->get('/feed/{usuario:[a-zA-Z0-9-_]+}', '\rede\Controllers\HomeController:feed_usuario');
$app->get('/config', '\rede\Controllers\HomeController:configuracao');
$app->get('/pesquisa', '\rede\Controllers\HomeController:pesquisa');
$app->get('/mensagem', '\rede\Controllers\HomeController:mensagem');
$app->get('/fotos', '\rede\Controllers\HomeController:fotos');


//usercontroller - POST
$app->post('/cadastrar', '\rede\Controllers\UserController:cadastrar');
$app->post('/login', '\rede\Controllers\UserController:login_usuario');
$app->post('/quem_sou_eu', '\rede\Controllers\UserController:quem_sou_eu');
$app->post('/nova_mensagem', '\rede\Controllers\UserController:nova_mensagem');

//Usercontroller - GET
$app->get('/logout', '\rede\Controllers\UserController:logout');
$app->run();
?>