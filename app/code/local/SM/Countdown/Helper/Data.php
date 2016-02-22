<?php
class SM_Countdown_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isEnable()
    {
        return (bool)Mage::getStoreConfig('countdown/countdown/enabled');
    }

    public function getTime()
    {
        if ($this->isEnable())
        {
            return Mage::getStoreConfig('countdown/countdown/time');
        }
        return false;
    }
}