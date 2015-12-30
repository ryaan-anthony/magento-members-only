<?php

class Ryaan_MembersOnly_Block_Price_Clone extends Mage_Catalog_Block_Product_View
{
    use Ryaan_MembersOnly_Block_TOverride;

    protected $rewriteBlocks = [
        'product.clone_prices',
        'product.info.addtocart',
        'product.info.addto'
    ];

    /**
     * Handle the non-member view
     */
    protected function handleGuestView()
    {
        if (in_array($this->getNameInLayout(), $this->rewriteBlocks)) {
            $this->setTemplate(null);
        }
    }
}
