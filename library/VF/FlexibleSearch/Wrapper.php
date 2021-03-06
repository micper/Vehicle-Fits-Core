<?php
/**
 * Vehicle Fits
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@vehiclefits.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Vehicle Fits to newer
 * versions in the future. If you wish to customize Vehicle Fits for your
 * needs please refer to http://www.vehiclefits.com for more information.
 * @copyright  Copyright (c) 2013 Vehicle Fits, llc
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class VF_FlexibleSearch_Wrapper
{
    /** @var VF_FlexibleSearch */
    protected $wrappedFlexibleSearch;

    function __construct(VF_FlexibleSearch_Interface $flexibleSearchToWrap)
    {
        $this->wrappedFlexibleSearch = $flexibleSearchToWrap;
    }

    function getParam($param)
    {
        if (is_numeric($this->getRequest()->getParam($param))) {
            return $this->getRequest()->getParam($param);
        }
        if (isset($_SESSION[$param])) {
            return $_SESSION[$param];
        }
    }

    function __call($methodName, $arguments)
    {
        $method = array($this->wrappedFlexibleSearch, $methodName);
        return call_user_func_array($method, $arguments);
    }

    /** @return Zend_Db_Statement_Interface */
    protected function query($sql)
    {
        return $this->getReadAdapter()->query($sql);
    }

    /** @return Zend_Db_Adapter_Abstract */
    protected function getReadAdapter()
    {
        return VF_Singleton::getInstance()->getReadAdapter();
    }
}