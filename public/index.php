<?php

require_once __DIR__ . '/../vendor/autoload.php';
Session_start();
use wesley\Page;
use wesley\PageAdmin;
use wesley\Model\User;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response)
{

    $interface = new Page();
    $interface->setTpl('index');
    return $response;

});

$app->get('/admin', function (Request $request, Response $response)
{
    User::verifyLogin();
    $interface = new PageAdmin();
    $interface->setTpl('index');
    return $response;

});

$app->get('/admin/login', function (Request $request, Response $response)
{
    $interface = new PageAdmin(
        [
            "header" => false,
            "footer" => false
        ]
    );
    $interface->setTpl('login');
    return $response;
});

$app->post('/admin/login', function ()
{
    User::Login($_POST['login'], $_POST['password']);
    header("Location: /admin");
    exit;
});

$app->get('/admin/logout', function ()
{
    User::Logout();
    header("Location: /admin/login");
    exit;
});

$app->get('/admin/users', function ()
{

   User::verifyLogin();

   $users = User::listAll();

   $interface = new PageAdmin();

   $interface->setTpl('users', array(
       "users" => $users
   ));

});

$app->get('/admin/users/create', function ()
{

    User::verifyLogin();

    $interface = new PageAdmin();

    $interface->setTpl('users-create');

});

$app->get('/admin/users/:idusers/delete', function ($idusers)
{

});
$app->get('/admin/users/:idusers', function ($idusers)
{

    User::verifyLogin();

    $interface = new PageAdmin();

    $interface->setTpl('users-update');

});

$app->post('/admin/users/create', function ()
{
   User::VerifyLogin();


});

$app->post('/admin/users/:iduser', function ($idusers)
{
    User::VerifyLogin();


});

$app->run();