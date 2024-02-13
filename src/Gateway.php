<?php

namespace Omnipay\FlexiCards;

use Omnipay\Common\AbstractGateway;
use Omnipay\FlexiCards\Traits\GatewayParameters;

class Gateway extends AbstractGateway
{
    use GatewayParameters;

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'FlexiCards';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultParameters()
    {
        return [
            'merchantId' => null,
            'loginId' => null,
            'password' => null,
            'apiKey' => null,
            'testMode' => false,
        ];
    }

    /**
     * Authorize and immediately capture an amount on the customers card
     *
     * @param array $options
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(\Omnipay\FlexiCards\Message\PurchaseRequest::class, $options);
    }

    /**
     * Handle return from off-site gateways after purchase
     *
     * @param array $options
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function completePurchase(array $options = [])
    {
        return $this->createRequest(\Omnipay\FlexiCards\Message\CompletePurchaseRequest::class, $options);
    }
}
