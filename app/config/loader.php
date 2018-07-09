<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        $config->application->modelsDir
    ]
)->registerNamespaces(
	[
		'App\Action' => APP_PATH . '/action',
		'App\Action\Auth' => APP_PATH . '/action/auth',
		'App\Action\Post' => APP_PATH . '/action/post',
		'App\Action\Theme' => APP_PATH . '/action/theme',
		'App\Action\Channel' => APP_PATH . '/action/channel',
		'App\Action\Publication' => APP_PATH . '/action/publication',
		'App\Exception' => APP_PATH . '/exception',
		'App\Exception\User' => APP_PATH . '/exception/user',
		'App\Exception\Post' => APP_PATH . '/exception/post',
		'App\Exception\Theme' => APP_PATH . '/exception/theme',
		'App\Exception\Channel' => APP_PATH . '/exception/channel',
		'App\Model' => APP_PATH . '/models',
		'App\Validator' => APP_PATH . '/validator',
		'App\Helper' => APP_PATH . '/helper',
		'App\Response' => APP_PATH . '/response',
		'App\Service' => APP_PATH . '/service'
	]
)->register();
