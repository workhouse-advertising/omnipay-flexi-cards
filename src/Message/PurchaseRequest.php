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
class PurchaseRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            // 'currency',
        );

        $data = [
            'merchant_id' => $this->getMerchantId(),
            'login_id' => $this->getLoginId(),
            'password' => $this->getPassword(),
            'api_key' => $this->getApiKey(),
            'merchant_transaction_id' => $this->getTransactionId(),
            'transaction_amount' => $this->getAmountInteger(),
            'url_response' => $this->getReturnUrl(),
            'direct_to_url_response' => $this->getDirectToUrlResponse(),
            // NOTE: Omitting `lineItems` as it is not functional in the sandbox environment
            //       and it's an optional field anyway. Until a root cause of the issue has been
            //       determined, it's sensible to also always exclude it for both sandbox and production.
            //       This also guarantees that the same data is tested in both environments.
            // 'lineItems' => $this->getLineItems(),
            'transmission_date_time' => $this->getTransmissionDateTime(),
        ];

        // Product code inclusion options.
        if (!is_null($this->getIncludeProductCodes())) {
            $data['include_product_codes'] = $this->getIncludeProductCodes();
        }

        // Product code exclusion options.
        if (!is_null($this->getExcludeProductCodes())) {
            $data['exclude_product_codes'] = $this->getExcludeProductCodes();
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/payment/paymenturl', rtrim($this->getBaseEndpoint(), '/'));
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\FlexiCards\Message\PurchaseResponse::class;
    }

    /**
     * Get the line items to add to the request.
     *
     * @return array
     */
    protected function getLineItems() : array
    {
        // TODO: Confirm that this is definitely the correct format for line items.
        //       Neither format works in the sandbox environment
        //       $lineItems = [
        //           'lineItem' => ['lineItem' => ....],
        //       ];
        $lineItems = [];

        foreach ($this->getItems() as $item) {
            $lineItems['lineItem'][] = [
                'merchant_product_code' => $item instanceof ItemInterface ? $item->getSku() : null,
                'description' => $item->getName() ? substr($item->getName(), 0, 50) : null,
                'quantity' => $item->getQuantity(),
                'amount' => (int) ($item->getPrice() * $item->getQuantity() * 100),
            ];
        }

        return $lineItems;
    }

    /**
     * Get the value for the 'includeProductCodes' parameter.
     *
     * @return mixed
     */
    public function getIncludeProductCodes()
    {
        return $this->getParameter('includeProductCodes');
    }

    /**
     * Set the 'includeProductCodes' parameter.
     *
     * @param $value
     * @return self
     */
    public function setIncludeProductCodes($value)
    {
        return $this->setParameter('includeProductCodes', $value);
    }

    /**
     * Get the value for the 'excludeProductCodes' parameter.
     *
     * @return mixed
     */
    public function getExcludeProductCodes()
    {
        return $this->getParameter('excludeProductCodes');
    }

    /**
     * Set the 'excludeProductCodes' parameter.
     *
     * @param $value
     * @return self
     */
    public function setExcludeProductCodes($value)
    {
        return $this->setParameter('excludeProductCodes', $value);
    }

    /**
     * Get the value for the 'directToUrlResponse' parameter.
     *
     * @return bool
     */
    public function getDirectToUrlResponse()
    {
        return (bool) ($this->getParameter('directToUrlResponse') ?? true);
    }

    /**
     * Set the 'directToUrlResponse' parameter.
     *
     * @param $value
     * @return self
     */
    public function setDirectToUrlResponse($value)
    {
        return $this->setParameter('directToUrlResponse', $value);
    }

    /**
     * Get the value for the 'transmissionDateTime' parameter.
     *
     * @return string
     */
    public function getTransmissionDateTime()
    {
        return $this->getParameter('transmissionDateTime') ?? date('YmdHis');
    }

    /**
     * Set the 'transmissionDateTime' parameter.
     *
     * @param $value
     * @return self
     */
    public function setTransmissionDateTime($value)
    {
        return $this->setParameter('transmissionDateTime', $value);
    }
}
