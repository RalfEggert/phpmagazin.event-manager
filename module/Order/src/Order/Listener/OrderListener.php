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

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Log\Logger;
use Zend\Mail\Message;
use Zend\Mail\Transport\File;
use Zend\Math\Rand;

/**
 * Class OrderListener
 *
 * Manage the order listener stuff
 *
 * @package Order
 */
class OrderListener implements ListenerAggregateInterface
{
    /**
     * @var array
     */
    protected $listeners = array();

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            'postOrder', array($this, 'sendConfirmation'), 100
        );

        $this->listeners[] = $events->attach(
            'postOrder', array($this, 'logOrder'), 300
        );

        $this->listeners[] = $events->attach(
            'preOrder', array($this, 'checkStock'), 1000
        );
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @var File
     */
    protected $mailTransport = null;

    /**
     * @param File $mailTransport
     */
    public function setMailTransport($mailTransport)
    {
        $this->mailTransport = $mailTransport;
    }

    /**
     * @return File
     */
    public function getMailTransport()
    {
        return $this->mailTransport;
    }

    /**
     * @var Logger
     */
    protected $orderLog = null;

    /**
     * @param Logger $orderLog
     */
    public function setOrderLog($orderLog)
    {
        $this->orderLog = $orderLog;
    }

    /**
     * @return Logger
     */
    public function getOrderLog()
    {
        return $this->orderLog;
    }

    /**
     * Check stock
     */
    public function checkStock(EventInterface $e)
    {
        // check stock
        $checkStock = Rand::getBoolean(true);

        // stop propagation if stock check failed
        if (!$checkStock) {
            $e->stopPropagation(true);
        }
    }

    /**
     * Send order confirmation
     */
    public function sendConfirmation(EventInterface $e)
    {
        /* @var $order \ArrayObject */
        $order = $e->getParam('order');

        // build message
        $message = new Message();
        $message->setEncoding('utf-8');
        $message->addFrom('info@meine-domain.de');
        $message->addTo('kunde@meine-domain.de');
        $message->setSubject('Bestellung eingegangen');
        $message->setBody(
            'Ihre Bestellung "' . $order->offsetGet('order_id')
            . '" ist eingegangen'
        );

        // send message
        $this->getMailTransport()->send($message);
    }

    /**
     * Log order to OrderLog
     */
    public function logOrder(EventInterface $e)
    {
        /* @var $order \ArrayObject */
        $order = $e->getParam('order');

        // log order
        $this->getOrderLog()->log(
            Logger::INFO,
            'Bestellung "' . $order->offsetGet('order_id') . '" gespeichert!'
        );
    }


}

