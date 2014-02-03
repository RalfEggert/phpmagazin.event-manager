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

namespace Order\Service;

use Order\Listener\OrderListener;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for OrderService
 *
 * Please add a proper description for the OrderService factory
 *
 * @package Order
 */
class OrderServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * Please add a proper description for this method
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return OrderService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $orderListener OrderListener */
        $orderListener = $serviceLocator->get('Order\Listener');

        /* @var $eventManager EventManager */
        $eventManager = $serviceLocator->get('EventManager');

        // add order listener
        $eventManager->attachAggregate($orderListener);

        // instantiate class
        $orderService = new OrderService();
        $orderService->setEventManager($eventManager);

        // return instance of class
        return $orderService;
    }


}

