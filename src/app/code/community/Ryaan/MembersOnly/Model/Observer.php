<?php

class Ryaan_MembersOnly_Model_Observer
{

    /**
     * @var string
     */
    protected $membersOnlyFlag = 'customer/membersonly/enable';

    /**
     * @return bool
     */
    protected function isMembersOnlyStore()
    {
        return Mage::getStoreConfigFlag($this->membersOnlyFlag);
    }

}
