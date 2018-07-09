<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

return [
	'paths' => [
		'migrations' => 'app/migrations'
	],
	'environments' => [
		'default_migration_table' => 'migration_versions',
		'default_database' => 'production',
		'production' => [
			'adapter' => getenv('DB_DRIVER'),
			'host' => getenv('DB_HOST'),
			'name' => getenv('DB_NAME'),
			'user' => getenv('DB_USER'),
			'pass' => getenv('DB_PASS'),
			'port' => getenv('DB_PORT'),
			'charset' => 'utf8',
			'collaction'=> 'utf8_unicode_ci'
		]
	]
];