<?php

namespace Omnipay\FlexiCards\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\FlexiCards\Traits\GatewayParameters;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use GatewayParameters;

    /**
     * @var string
     */
    protected $liveBaseEndpoint = 'https://api.flexilongtermfinance.co.nz/api/gateway/rest/v1';

    /**
     * @var string
     */
    protected $testBaseEndpoint = 'https://api.flexilongtermfinance.co.nz/api/simulator/gateway/rest/v1';

    /**
     * @inheritDoc
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Get the base endpoint URL.
     *
     * @return string
     */
    protected function getBaseEndpoint()
    {
        return $this->getTestMode() ? $this->testBaseEndpoint : $this->liveBaseEndpoint;
    }
}
