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
 * namespace definition and usage
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * I18n controller
 *
 * Handles the i18n pages
 *
 * @package    Application
 */
class I18nController extends AbstractActionController
{
    /**
     * Handle homepage
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
