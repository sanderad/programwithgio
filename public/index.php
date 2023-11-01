<?php

use App\App;
use App\Controllers\CurlController;
use App\Controllers\HomeController;
use App\Controllers\InvoicesController;
use App\Controllers\PracticeController;
use App\Controllers\UsersController;
use App\DbCredentials;
use App\Router;
use Illuminate\Container\Container;

require_once __DIR__ . '/../vendor/autoload.php';


/*The code define('STORAGE_PATH', __DIR__ . '/../storage'); is defining a constant named STORAGE_PATH in PHP. The value of this constant is set to the result of concatenating the current directory (__DIR__) with the relative path '/../storage' */
define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEWS_PATH', __DIR__ . '/../views/');
define('VIEWS_PATH_INVOICES', __DIR__ . '/../views/invoices/');

$container = new Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttributes(
        [
                HomeController::class,
                PracticeController::class,
                InvoicesController::class,
                UsersController::class,
                CurlController::class
        ]
        );


(new App(
        $container,
        $router,
        ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->boot()->run();
