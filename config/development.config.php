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
 * Application configuration
 *
 * @package    Application
 */
return array(
    'modules'                 => array(
        'Application',
        'ZendDeveloperTools',
    ),
    'module_listener_options' => array(
        'config_glob_paths'        => array(
            'config/autoload/{,*.}{production,development}.php',
        ),
        'module_paths'             => array(
            './module',
            './vendor',
        ),
        'cache_dir'                => './data/cache',
        'config_cache_enabled'     => false,
        'config_cache_key'         => 'module_config_cache',
        'module_map_cache_enabled' => false,
        'module_map_cache_key'     => 'module_map_cache',
    ),
);
