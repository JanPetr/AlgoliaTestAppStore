<?php

/**
 * The Nette Tester command-line runner can be
 * invoked through the command: ../vendor/bin/tester .
 */

if(@!include __DIR__.'/../vendor/autoload.php')
{
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

// Load framework
require_once __DIR__.'/../MVC/loader.php';

define('TEMP_DIR', __DIR__.'/tmp/'.lcg_value());
@mkdir(TEMP_DIR, 0777, TRUE); // @ - base directory may already exist
register_shutdown_function(function ()
{
	Tester\Helpers::purge(TEMP_DIR);
	rmdir(TEMP_DIR);
});
