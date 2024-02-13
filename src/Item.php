<?php

namespace Omnipay\FlexiCards;

use Omnipay\Common\Item as BaseItem;
use Omnipay\FlexiCards\ItemInterface;

class Item extends BaseItem implements ItemInterface
{
    /**
     * @inheritDoc
     */
    public function getMerchantProductCode()
    {
        return $this->getParameter('merchantProductCode');
    }

    /**
     * @inheritDoc
     */
    public function setMerchantProductCode($value)
    {
        return $this->setParameter('merchantProductCode', $value);
    }
}