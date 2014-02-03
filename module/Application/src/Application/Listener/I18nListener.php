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
 * Class I18nListener
 *
 * Manage the order listener stuff
 *
 * @package Order
 */
class I18nListener implements ListenerAggregateInterface
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
            MvcEvent::EVENT_ROUTE,
            array($this, 'setupLocalization'),
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
     * Setup localization
     */
    public function setupLocalization(EventInterface $e)
    {
        // get current language, default to 'de'
        $lang     = $e->getRouteMatch()->getParam('lang', 'de');
        $currency = $lang == 'en' ? 'USD' : 'EUR';

        // change Locale
        \Locale::setDefault($lang);

        $serviceManager = $e->getApplication()->getServiceManager();
        $viewManager    = $serviceManager->get('viewmanager');

        $currencyHelper = $viewManager->getRenderer()->plugin('currencyformat');
        $currencyHelper->setCurrencyCode($currency);
        $currencyHelper->setShouldShowDecimals(true);
    }
}

