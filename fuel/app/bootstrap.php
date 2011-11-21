<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
        "View_Twig" => APPPATH."classes/twig.php",
));

// Register the autoloader
Autoloader::register();

// load backspace config
require_once APPPATH.'backspace.conf.php';

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGE
 * Fuel::PRODUCTION
 */
//Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// BS_WORKING_ENVIRONMENT determines the env
Fuel::$env = defined(BS_WORKING_ENVIRONMENT)
                ? BS_WORKING_ENVIRONMENT
                : Fuel::DEVELOPMENT;

// Initialize the framework with the config file.
Fuel::init('config.php');
