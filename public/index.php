<?php

require_once '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;
use Dmkit\Phalcon\Auth\Middleware\Micro as AuthMicro;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

set_exception_handler(function ($exception) {
	header('Content-type: application/json');
	http_response_code($exception->getCode());
	echo json_encode([
		'message' => $exception->getMessage()
	]);
});

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers the services that
     * provide a full stack framework. These default services can be overidden with custom ones.
     */
    $di = new FactoryDefault();

    /**
     * Include Services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Starting the application
     * Assign service locator to the application
     */
    $app = new Micro($di);

	$authConfig = [
		'secretKey' => '923753F2317FC1EE5B52DF23951B1',
		'payload' => [
			'exp' => 1440,
			'iss' => 'phalcon-jwt-auth'
		],
		'ignoreUri' => [
			'/',
			'/api',
			'/api/auth',
			'/api/auth/login'
		]
	];

	// AUTH MICRO
	$auth = new AuthMicro($app, $authConfig);

	$auth->onUnauthorized(function($authMicro, $app) {

		$response = $app["response"];
		$response->setStatusCode(401, 'Unauthorized');
		$response->setContentType("application/json");

		// to get the error messages
		$response->setContent(json_encode(['message' => 'Invalid token']));
		$response->send();

		// return false to stop the execution
		return false;
	});

    /**
     * Include Application
     */
    include APP_PATH . '/app.php';

    /**
     * Handle the request
     */
    $app->handle();

} catch (\Exception $e) {
	$response = $app["response"];
	$response->setContentType("application/json");

	if ($e instanceof \App\Exception\ApiException) {
		$response->setStatusCode($e->getCode());
		$response->setJsonContent([
			'message' => $e->getMessage()
		]);
	} else {
		$response->setStatusCode(500);
		$response->setJsonContent([
			'message' => $e->getMessage()
		]);
	}
	$response->send();
}
