<?php

namespace Omnipay\FlexiCards\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\FlexiCards\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getData()['process_no'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return $this->getData()['payment_url'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isTransparentRedirect()
    {
        return true;
    }
}
