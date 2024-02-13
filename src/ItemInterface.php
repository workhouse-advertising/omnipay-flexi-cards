<?php

namespace Omnipay\FlexiCards;

use Omnipay\Common\ItemInterface as BaseItemInterface;

interface ItemInterface extends BaseItemInterface
{
    /**
     * Get the `merchantProductCode` for this item.
     *
     * @return string|null
     */
    public function getMerchantProductCode();

    /**
     * Set the item `merchantProductCode`.
     *
     * @return self
     */
    public function setMerchantProductCode($value);
}
