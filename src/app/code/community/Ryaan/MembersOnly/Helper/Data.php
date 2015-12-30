<?php

class Ryaan_MembersOnly_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Get the login url with referrer
     * @return string
     */
    public function getLoginUrl()
    {
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();

        $currentUrlEncoded = Mage::helper('core')->urlEncode($currentUrl);

        return Mage::getUrl('customer/account/login', ['referer' => $currentUrlEncoded]);
    }

    /**
     * Get the login message
     * @return string
     */
    public function getLoginMessage()
    {
        return sprintf($this->__('LOGIN_TO_SEE_PRICE'), $this->getLoginUrl());
    }

    /**
     * Display the notice
     * @param string
     */
    public function displayNotice($notice)
    {
        $translatedNotice = $this->__($notice);

        $coreSession = $this->getCoreSession();

        $coreSession->addNotice($translatedNotice);
    }

    /**
     * @return Mage_Core_Model_Session
     */
    protected function getCoreSession()
    {
        return Mage::getSingleton('core/session');
    }
}
