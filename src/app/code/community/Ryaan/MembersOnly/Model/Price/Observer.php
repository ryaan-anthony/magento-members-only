<?php

class Ryaan_MembersOnly_Model_Price_Observer extends Ryaan_MembersOnly_Model_Observer
{
    /**
     * Price template visible to non-logged in visitors
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

        // override all instances of price block
        if ($block instanceof Mage_Catalog_Block_Product_Price) {

            // members-only is enabled for store
            if ($this->isMembersOnlyStore()) {

                $customerSession = $this->getCustomerSession();

                // customer is not logged in
                if (!$customerSession->isLoggedIn()) {

                    $block->setTemplate($this->priceTemplate);

                }
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
