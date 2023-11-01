<?php

declare (strict_types = 1);

namespace App;

use App\Contracts\EmailValidationInterface;
use App\Exceptions\RouteNotFoundException;
use App\Services\Emailable\EmailValidationService;
use App\Services\PaymentGatewayService;
use App\Services\PaymentGatewayServiceInterface;
use Dotenv\Dotenv;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\Intl\IntlExtension;

class App
{


    private DbCredentials $dbCredentials;
    public function __construct(
        protected Container $container,
        protected ?Router $router = null, 
        protected array $request = [], 

        ) 
    {
        /* we are trying to bind the interface to the specific service without using closures so we have to modify our container in order to assign a interface to a class using the fully qualified name instead  */
 
    }

    public function initDb(array $dbCredentials)
    {
        $capsule = new Capsule();

    $dotenv = Dotenv::createImmutable(__DIR__) ;
    $dotenv->load();

 

    $capsule->addConnection($dbCredentials);
 
    // Set the event dispatcher used by Eloquent models... (optional)
    $capsule->setEventDispatcher(new Dispatcher($this->container));

    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();
    }

    public function boot(): static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__) . '/app/');
        $dotenv->load();

        $this->dbCredentials = new DbCredentials($_ENV);

        $this->initDb($this->dbCredentials->db);

        $loader = new FilesystemLoader(VIEWS_PATH);
        $twig = new Environment($loader, [
            'cache' => STORAGE_PATH . '/cache',
            'auto_reload' => true
        ]);

        
        $twig->addExtension(new IntlExtension());

        $this->container->bind(
            PaymentGatewayServiceInterface::class, 
            PaymentGatewayService::class);
        $this->container->singleton(Environment::class, fn() => $twig);

        $this->container->bind(MailerInterface::class, fn() => new CustomMailer($this->dbCredentials->mailer['dsn']));
        $this->container->bind(EmailValidationInterface::class, fn() => new EmailValidationService($this->dbCredentials->apiKeys['emailable']));


        return $this;
    }

    public function run()
    {
        try {
        echo $this->router->resolve($this->request['uri'],strtolower($this->request['method']));
    } catch (RouteNotFoundException) {
        // header('HTTP/1.1 404 Page Not Found');
        http_response_code(404);
        echo Views::make('error/404');
    } 
    }
}