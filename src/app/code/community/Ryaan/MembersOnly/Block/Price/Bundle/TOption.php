<?php

trait Ryaan_MembersOnly_Block_Price_Bundle_TOption
{
    /**
     * @var Ryaan_MembersOnly_Helper_Config
     */
    protected $config;

    /**
     * Initialize the class
     */
    protected function _construct()
    {
        list($this->config) = $this->checkTypes(
            $this->nullCoalesce($this->getArgs(), 'config', Mage::helper('membersonly/config'))
        );

        parent::_construct();
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
     * Determine if is guest view
     * @return bool
     */
    protected function isGuestView()
    {
        $customerSession = $this->getCustomerSession();

        return $this->config->isMembersOnlyStore() && !$customerSession->isLoggedIn();
    }

    /**
     * Get title price for selection product
     *
     * @param Mage_Catalog_Model_Product $_selection
     * @param bool $includeContainer
     * @return string
     */
    public function getSelectionTitlePrice(Mage_Catalog_Model_Product $_selection, $includeContainer = true)
    {
        if ($this->isGuestView()) {

            return $this->escapeHtml($_selection->getName());

        }

        return parent::getSelectionTitlePrice($_selection, $includeContainer);
    }

    /**
     * Returns the formatted string for the quantity chosen for the given selection
     *
     * @param Mage_Catalog_Model_Product $_selection
     * @param bool                       $includeContainer
     * @return string
     */
    public function getSelectionQtyTitlePrice(Mage_Catalog_Model_Product $_selection, $includeContainer = true)
    {
        if ($this->isGuestView()) {

            return $_selection->getSelectionQty() * 1 . ' x ' . $this->escapeHtml($_selection->getName());

        }

        return parent::getSelectionQtyTitlePrice($_selection, $includeContainer);
    }

    /**
     * @return Mage_Customer_Model_Session
     */
    protected function getCustomerSession()
    {
        return Mage::getSingleton('customer/session');
    }


}
