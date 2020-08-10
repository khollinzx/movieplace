<?php

session_start();

// Localhost Confiquration
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'port' => '3306',
		'password' => '',
		'db' => 'movie_market_db'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);


spl_autoload_register(function ($class) {
	require_once(ROOT_PATH . 'classes/' . $class . '.php');
});

// set the database cridentials to access the needed database
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "movie_market_db");
define("DB_PORT", "3306"); //default port is 3306
define("DB_USER", "root");
define("DB_PASS", ""); //default password

require_once(ROOT_PATH . 'functions/sanitize.php');
require_once(ROOT_PATH . 'functions/select_all.php');
require_once(ROOT_PATH . 'functions/JWT-Credentials.php');


if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('user_session', array('hash', '=', $hash));

	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
