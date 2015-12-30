<?php

class Ryaan_MembersOnly_Block_Price_Clone extends Mage_Catalog_Block_Product_View
{
    use Ryaan_MembersOnly_Block_TOverride;

    const NAME_IN_LAYOUT = 'product.clone_prices';

    /**
     * Handle the non-member view
     */
    protected function handleGuestView()
    {
        if ($this->getNameInLayout() == self::NAME_IN_LAYOUT) {
            $this->setTemplate(null);
        }
    }
}
