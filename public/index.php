<?php
/**
 * Zend Framework 2 - MySkeletonApplication
 *
 * Gepimpte SkeletonApplication für das Zend Framework 2,
 * 
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * Application setup
 * 
 * @package    Application
 */

// define application path
define('APPLICATION_ROOT', realpath(__DIR__ . '/..'));

// setup autoloading
require_once '../vendor/autoload.php';

// change dir
chdir(dirname(__DIR__));

// set configuration file
$config = include APPLICATION_ROOT . '/config/application.config.php';

// Run the application!
Zend\Mvc\Application::init($config)->run();
