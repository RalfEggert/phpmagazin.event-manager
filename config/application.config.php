<?php
/**
 * Configuration file generated by FrilleZFTool
 *
 * The previous configuration file is stored in ./config/application.config.old
 *
 * @see https://github.com/RalfEggert/FrilleZFTool
 */


return array(
    'modules' => array(
        'Application',
        'ZendDeveloperTools',
        'Order'
        ),
    'module_listener_options' => array(
        'config_glob_paths' => array('config/autoload/{,*.}{global,local}.php'),
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'cache_dir' => './data/cache',
        'config_cache_enabled' => false,
        'config_cache_key' => 'module_config_cache',
        'module_map_cache_enabled' => false,
        'module_map_cache_key' => 'module_map_cache'
        )
    );
