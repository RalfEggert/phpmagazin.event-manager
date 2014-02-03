<?php
/**
 * Zend Framework 2 - PHP-Magazin Event-Manager
 *
 * Beispiele für ZF2 Event-Manager
 *
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * Application module configuration
 *
 * @package    Application
 */
return array(
    'router'          => array(
        'routes' => array(
            'home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'i18n' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/i18n[/:lang]',
                    'defaults' => array(
                        'controller' => 'i18n',
                        'action'     => 'index',
                        'lang'       => 'de',
                    ),
                    'constraints' => array(
                        'lang'  => '[a-z]{2}'
                    ),
                ),
            ),
        ),
    ),

    'controllers'     => array(
        'invokables' => array(
            'index' => 'Application\Controller\IndexController',
            'i18n'  => 'Application\Controller\I18nController',
        ),
    ),

    'view_manager'    => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => include
                __DIR__ . '/../view/template_map.php',
        'template_path_stack'      => array(
            __DIR__ . '/../view',
        ),
    ),

    'service_manager' => array(
        'factories'          => array(
            'Mail\Transport\File' => 'Application\Mail\Transport\FileFactory',
        ),
        'abstract_factories' => array(
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    ),
);
