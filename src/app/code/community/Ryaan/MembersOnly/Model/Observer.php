<?php

class Ryaan_MembersOnly_Model_Observer
{
    /**
     * Publicly visible price template
     * @var string
     */
    protected $priceTemplate = 'membersonly/catalog/price.phtml';

    /**
     * Override the price template for non-logged in users.
     * @param Varien_Event_Observer $observer
     */
    public function overridePriceTemplate(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        $block = $event->getBlock();

        if ($block instanceof Mage_Catalog_Block_Product_Price) {

            $customerSession = $this->getCustomerSession();

            if (!$customerSession->isLoggedIn()) {

                $block->setTemplate($this->priceTemplate);

            }

        }

    }

    /**
     * @return Mage_Customer_Model_Session
     */
    protected function getCustomerSession()
    {
        return Mage::getSingleton('customer/session');
    }

}
