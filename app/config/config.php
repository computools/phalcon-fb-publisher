<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'    => 'Mysql',
        'host'       => getenv('DB_HOST'),
        'username'   => getenv('DB_USER'),
        'password'   => getenv('DB_PASS'),
        'dbname'     => getenv('DB_NAME'),
        'charset'    => 'utf8',
    ],

    'application' => [
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'baseUri'        => '/template/',
		'encryptionKey' => 'Es5h#$rhE_eh%67lpoOQalgwlyG'
    ],
	'jwt' => [
		'secret' => getenv('JWT_SECRET'),
		'ttl' => getenv('JWT_TTL')
	],
	'facebook' => [
		'config' => [
			'app_id' => getenv('FACEBOOK_APP_ID'),
			'app_secret' => getenv('FACEBOOK_APP_SECRET'),
			'default_graph_version' => getenv('FACEBOOK_DEFAULT_GRAPH_VERSION'),
		],
		'redirect_uri' => getenv('REDIRECT_URI')
	]
]);
