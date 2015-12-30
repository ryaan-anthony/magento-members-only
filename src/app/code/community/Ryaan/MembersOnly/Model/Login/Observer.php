<?php

class Ryaan_MembersOnly_Model_Login_Observer
{
    /**
     * @var Ryaan_MembersOnly_Helper_Config
     */
    protected $config;

    /**
     * @var Ryaan_MembersOnly_Helper_Data
     */
    protected $helper;

    /**
     * Initialize the class
     * @param array
     */
    public function __construct(array $args = [])
    {
        list($this->config, $this->helper) = $this->checkTypes(
            $this->nullCoalesce($args, 'config', Mage::helper('membersonly/config')),
            $this->nullCoalesce($args, 'helper', Mage::helper('membersonly'))
        );
    }

    /**
     * Return the value at field in array if it exists. Otherwise, use the
     * default value.
     * @param  array
     * @param  string|int
     * @param  mixed
     * @return mixed
     */
    protected function nullCoalesce(array $arr, $field, $default)
    {
        return isset($arr[$field]) ? $arr[$field] : $default;
    }

    /**
     * Validate constructor parameters.
     * @param Ryaan_MembersOnly_Helper_Config
     * @param Ryaan_MembersOnly_Helper_Data
     * @return array
     */
    protected function checkTypes(
        Ryaan_MembersOnly_Helper_Config $config,
        Ryaan_MembersOnly_Helper_Data $helper
    ) {
        return func_get_args();
    }

    /**
     * Determine if customer has been approved and log them out with a notice
     * if they have not yet been approved.
     * @param Varien_Event_Observer $observer
     */
    public function redirectLoginNotApproved(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        // members-only is enabled for store
        if ($this->config->isMembersOnlyStore()) {

            /** @var Mage_Customer_Model_Customer $customer */
            $customer = $event->getCustomer();

            if (!$customer->getMemberApproved()) {

                $customerSession = $this->getCustomerSession();

                $customerSession->logout();

                $customerSession->renewSession();

                $this->helper->displayNotice('CUSTOMER_NOT_APPROVED');

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
