<?php

class Ryaan_MembersOnly_Model_Login_Observer extends Ryaan_MembersOnly_Model_Observer
{

    /**
     * Determine if customer has been approved and log them out with a notice
     * if they have not yet been approved.
     * @param Varien_Event_Observer $observer
     */
    public function redirectLoginNotApproved(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        // members-only is enabled for store
        if ($this->isMembersOnlyStore()) {

            /** @var Mage_Customer_Model_Customer $customer */
            $customer = $event->getCustomer();

            if (!$customer->getMemberApproved()) {

                $customerSession = $this->getCustomerSession();

                $customerSession->logout();

                $customerSession->renewSession();

                $this->getHelper()->displayNotice('CUSTOMER_NOT_APPROVED');

            }

        }
    }

    /**
     * @return Ryaan_MembersOnly_Helper_Data
     */
    protected function getHelper()
    {
        return Mage::helper('membersonly');
    }

    /**
     * @return Mage_Customer_Model_Session
     */
    protected function getCustomerSession()
    {
        return Mage::getSingleton('customer/session');
    }

}
