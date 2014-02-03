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

use Zend\Config\Factory;
use Zend\EventManager\EventManagerInterface;
use Zend\Math\Rand;

/**
 * Class OrderService
 *
 * Manage the order service stuff
 *
 * @package Order
 */
class OrderService
{
    /**
     * @var EventManagerInterface
     */
    protected $eventManager = null;

    /**
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     *
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers(array(__CLASS__));

        $this->eventManager = $eventManager;
    }

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * Save order
     */
    public function saveOrder()
    {
        // get products
        $productList = Factory::fromFile(
            APPLICATION_ROOT . '/module/Order/config/products.config.php'
        );

        // create random order
        $order = new \ArrayObject(array(
            'order_id'   => Rand::getInteger(1000, 9999, true),
            'order_item' => $productList[array_rand($productList)],
        ));

        // trigger preOrder event
        $result = $this->getEventManager()->trigger(
            'preOrder', __CLASS__, array('order' => $order)
        );

        // check preOrder event
        if ($result->stopped()) {
            return false;
        }

        file_put_contents(
            APPLICATION_ROOT . '/data/order/' . $order->offsetGet('order_id'),
            serialize($order)
        );

        $this->getEventManager()->trigger(
            'postOrder', __CLASS__, array('order' => $order)
        );

        return $order;
    }
}

