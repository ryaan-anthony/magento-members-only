<?php

class Ryaan_MembersOnly_Block_Price_Default extends Mage_Catalog_Block_Product_Price
{
    use Ryaan_MembersOnly_Block_TOverride;

    /**
     * Price template visible to non-logged in visitors
     * @var string
     */
    const PRICE_TEMPLATE = 'membersonly/catalog/price.phtml';

    protected $templateRewrites = [
        'catalog/product/price.phtml',
        'bundle/catalog/product/price.phtml',
    ];

    /**
     * Handle the non-member view
     */
    protected function handleGuestView()
    {
        $this->setTemplate($this->isRewrite() ? self::PRICE_TEMPLATE : null);
    }

    protected function isRewrite()
    {
        return in_array($this->getTemplate(), $this->templateRewrites);
    }
}
