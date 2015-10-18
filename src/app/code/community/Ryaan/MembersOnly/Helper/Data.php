<?php

class Ryaan_MembersOnly_Helper_Data extends Mage_Core_Helper_Abstract
{

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
