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

namespace Application\Mail\Transport;

use Zend\Mail\Transport\File;
use Zend\Mail\Transport\FileOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for File Mail Transport
 *
 * Please add a proper description for the FileFactory factory
 *
 * @package Application
 */
class FileFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * Please add a proper description for this method
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return File
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // setup options
        $options = new FileOptions(
            array(
                'path' => APPLICATION_ROOT . '/data/mail',
            )
        );

        // instantiate class
        $fileTransport = new File($options);

        // return instance of class
        return $fileTransport;
    }


}

