<?php

namespace App\BrowserCheck;

use Qs_Array;
use Qs_ViewController;
use Zend_Registry;

class View extends Qs_ViewController
{
    const TEMPLATE_VARIABLE = 'BROWSER_ALERT';
    const COOKIE_NAME = 'browserAlert';
    const CONTAINER_CLASS = 'browser_alert';
    const IE_ALERT_VERSION = 10;

    /** View @var */
    protected static $_instance;

    /**
     * @return View
     */
    public function exec()
    {
        return $this;
    }

    /**
     * @return View
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new View();
        }
        return static::$_instance;
    }

    /**
     * @return bool
     */
    protected static function _isOldIe()
    {
        $agent = Qs_Array::get($_SERVER, 'HTTP_USER_AGENT', '');
        if (false !== ($offset = strpos($agent, 'MSIE'))) {
            $version = ltrim(substr($agent, $offset + 4));
            $version = (int) substr($version, 0, strpos($version, ' '));
            if ($version && self::IE_ALERT_VERSION >= $version) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    protected static function _showAlert()
    {
        if (array_key_exists(self::COOKIE_NAME, $_COOKIE)) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public static function initAlert()
    {
        if (!constant('BROWSER_CHECK')) {
            return false;
        }

        if (static::_showAlert() && static::_isOldIe()) {
            /** @var View $view */
            $view = self::getInstance();

            /** @var \Qs_Doc $doc */
            $doc = Zend_Registry::get('doc');

            $item = array();
            $item['cookieName'] = self::COOKIE_NAME;
            $item['containerClass'] = self::CONTAINER_CLASS;
            $item['tpl'] = $view->getTemplate('alert.tpl');

            $doc->assign(self::TEMPLATE_VARIABLE, $item);
        }

        return true;
    }
}
