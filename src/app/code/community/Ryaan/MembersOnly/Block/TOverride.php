<?php

trait Ryaan_MembersOnly_Block_TOverride
{
    /**
     * @var Ryaan_MembersOnly_Helper_Config
     */
    protected $config;

    /**
     * Initialize the class
     * @throws Mage_Core_Exception
     */
    public function _construct()
    {
        list($this->config) = $this->checkTypes(
            $this->nullCoalesce($this->getArgs(), 'config', Mage::helper('membersonly/config'))
        );

        if (!$this instanceof Mage_Core_Block_Template) {
            throw Mage::exception('Mage_Core', 'Invalid use of trait '.get_class());
        }
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
     * @return array
     */
    protected function checkTypes(
        Ryaan_MembersOnly_Helper_Config $config
    ) {
        return func_get_args();
    }

    /**
     * Handle the non-member view
     */
    abstract protected function handleGuestView();

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        // members-only is enabled for store
        if ($this->config->isMembersOnlyStore()) {

            $customerSession = $this->getCustomerSession();

            // customer is not logged in
            if (!$customerSession->isLoggedIn()) {

                $this->handleGuestView();

            }
        }

        return parent::_toHtml();
    }

    /**
     * @return Mage_Customer_Model_Session
     */
    protected function getCustomerSession()
    {
        return Mage::getSingleton('customer/session');
    }

}
