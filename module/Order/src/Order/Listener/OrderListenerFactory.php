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

namespace Order\Listener;

use Zend\Log\Logger;
use Zend\Mail\Transport\File;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for OrderListener
 *
 * Please add a proper description for the OrderListener factory
 *
 * @package Order
 */
class OrderListenerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * Please add a proper description for this method
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return OrderListener
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $mailTransport File */
        $mailTransport = $serviceLocator->get('Mail\Transport\File');

        /* @var $orderLog Logger */
        $orderLog = $serviceLocator->get('Order\Log');

        // instantiate class
        $orderListener = new OrderListener();
        $orderListener->setMailTransport($mailTransport);
        $orderListener->setOrderLog($orderLog);

        // return instance of class
        return $orderListener;
    }


}

