<?php
/**
 * This file was generated by FrilleZFTool.
 *
 * @package Order
 * @see https://github.com/RalfEggert/FrilleZFTool
 */


namespace Order\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for IndexController
 *
 * Please add a proper description for the IndexController factory
 *
 * @package Order
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * Please add a proper description for this method
     *
     * @param ServiceLocatorInterface $controllerLoader
     * @return IndexController
     */
    public function createService(ServiceLocatorInterface $controllerLoader)
    {
        // get service locator to fetch other services
        $serviceLocator = $controllerLoader->getServiceLocator();

        // get all services that need to be injected
        $orderService = $serviceLocator->get('Order\Service');

        // instantiate class
        $controller = new IndexController();

        // inject all services 
        $controller->setOrderService($orderService);

        // return instance of class
        return $controller;
    }


}

