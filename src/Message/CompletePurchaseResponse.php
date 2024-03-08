<?php

namespace Omnipay\FlexiCards\Message;

use Omnipay\FlexiCards\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        // NOTE: Only the string "00" is expected for successful payments.
        return $this->getPaymentStatusCode() === '00';
    }

    /**
     * @inheritDoc
     */
    public function inProgress()
    {
        // NOTE: Only the string "02" is expected for payments still being processed/in progress.
        return $this->getPaymentStatusCode() === '02';
    }

    /**
     * @inheritDoc
     */
    public function getPaymentStatusCode()
    {
        return $this->getPaymentStatus()['statusCode'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getPaymentStatusCodeDescription()
    {
        return $this->getPaymentStatus()['statusDesc'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getPaymentStatus()
    {
        return $this->getData()['paymentStatus'] ?? null;
    }
}
