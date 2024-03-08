<?php

namespace Omnipay\FlexiCards\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\FlexiCards\ItemInterface;
use Omnipay\FlexiCards\Message\AbstractRequest;
use Omnipay\FlexiCards\Message\PurchaseResponse;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        // $this->validate(
        //     // 'amount',
        //     // 'currency',
        //     'processNo',
        // );

        $data = [
            'merchant_id' => $this->getMerchantId(),
            'login_id' => $this->getLoginId(),
            'password' => $this->getPassword(),
            'api_key' => $this->getApiKey(),
            'process_no' => $this->getProcessNo(),
            'merchant_transaction_id' => $this->getTransactionId(),
            'transmission_date_time' => $this->getTransmissionDateTime(),
        ];

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getHttpMethod()
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    protected function getApiKey()
    {
        return $this->getPaymentStatusApiKey();
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/payment/paymentstatus', rtrim($this->getBaseEndpoint(), '/'));
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\FlexiCards\Message\CompletePurchaseResponse::class;
    }

    /**
     * Get the value for the 'processNo' parameter.
     *
     * @return mixed
     */
    public function getProcessNo()
    {
        return $this->getParameter('processNo') ?? $this->getTransactionReference();
    }

    /**
     * Set the 'processNo' parameter.
     *
     * @param $value
     * @return self
     */
    public function setProcessNo($value)
    {
        return $this->setParameter('processNo', $value);
    }
}
