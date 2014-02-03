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

namespace Application\Listener;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class ViewListener
 *
 * Manage the order listener stuff
 *
 * @package Order
 */
class ViewListener implements ListenerAggregateInterface
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
            MvcEvent::EVENT_FINISH,
            array($this, 'addTimeStamp'),
            -100
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
     * Purify HTML output
     */
    public function addTimeStamp(EventInterface $e)
    {
        $body = $e->getResponse()->getContent();

        $html = '<div class="container" style="margin-bottom: 10px;">';
        $html.= '<span class="label label-primary">';
        $html.= round(microtime(true) - TIMESTAMP_START, 5) * 1000 . 'ms';
        $html.= '</span>';
        $html.= '</div>';

        $e->getResponse()->setContent(
            str_replace('</footer>', $html . '</footer>', $body)
        );
    }
}

