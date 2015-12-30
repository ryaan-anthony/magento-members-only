<?php

class Ryaan_MembersOnly_Helper_Config
{
    /**
     * @var string
     */
    const MEMBERS_ONLY_FLAG = 'customer/membersonly/enable';

    /**
     * @return bool
     */
    public function isMembersOnlyStore()
    {
        return Mage::getStoreConfigFlag(self::MEMBERS_ONLY_FLAG);
    }

}
