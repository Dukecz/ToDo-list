<?php
include ("../../libs/Dibi/dibi.php");

	if (!isset($_GET["q"])) { die(); }
	$username = $_GET["q"];

	try {
    dibi::connect(array(
                'driver' => 'mysql',
                'host' => 'localhost',
                'username' => 'todolist',
                'password' => '9GBmEmnNusxdyedp',
                'database' => 'todolist',
                'charset' => 'utf8',
                'profiler' => TRUE,
    ));
		$result = dibi::query('SELECT * FROM `users` WHERE username = %s', $username);  // kontrola jestli je jméno již v db
	} catch (DibiException $e) {
    echo get_class($e), ': ', $e->getMessage(), "\n";
	}

	echo count($result);
?>
