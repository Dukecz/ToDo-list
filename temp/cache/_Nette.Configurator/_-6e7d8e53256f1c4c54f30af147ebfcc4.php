<?php //netteCache[01]000211a:2:{s:4:"time";s:21:"0.89486600 1323196874";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:41:"/srv/http/nette/ToDo-list/app/config.neon";i:2;i:1323196874;}}}?><?php
// source file /srv/http/nette/ToDo-list/app/config.neon

$container->addService('robotLoader', function($container) {
	$service = call_user_func(
		array ( 0 => 'Nette\\Configurator', 1 => 'createServicerobotLoader', ),
		$container
	);
	return $service;
}, array ( 0 => 'run', ));

$container->addService('model', function($container) {
	$class = 'Model'; $service = new $class($container->getService('database'));
	return $service;
}, NULL);

$container->addService('authenticator', function($container) {
	$service = call_user_func(
		array ( 0 => $container->getService('model'), 1 => 'createAuthenticatorService', ),
		$container
	);
	return $service;
}, NULL);

$container->params['database'] = array (
  'class' => 'DibiConnection',
  'driver' => 'mysql',
  'hostname' => 'localhost',
  'username' => 'todolist',
  'password' => '9GBmEmnNusxdyedp',
  'database' => 'todolist',
  'charset' => 'utf8',
  'profiler' => true,
  'lazy' => true,
);

date_default_timezone_set('Europe/Prague');

Nette\Caching\Storages\FileStorage::$useDirectories = true;

foreach ($container->getServiceNamesByTag("run") as $name => $foo) { $container->getService($name); }
