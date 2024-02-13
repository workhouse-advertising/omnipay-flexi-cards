<?php

namespace Omnipay\FlexiCards\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Common\Message\AbstractResponse;
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
     * @inheritDoc
     */
    public function getRequestHeaders()
    {
        return [];
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

    /**
     * Get the specific request endpoint URL.
     *
     * @return string
     */
    abstract protected function getEndpoint();

    /**
     * Get the FQCN to use for a response.
     *
     * @return string
     */
    abstract public function getResponseClass(): string;

    /**
     * Create a response from the response data.
     *
     * @return \Omnipay\Common\Message\AbstractResponse
     */
    protected function makeResponse($responseData): AbstractResponse
    {
        $responseClass = $this->getResponseClass();
        return new $responseClass($this, $responseData);
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $requestBody = ($this->getHttpMethod() == 'GET') ? null : json_encode($data);
        $requestParams = ($this->getHttpMethod() == 'GET') ? '?' . http_build_query($data) : '';

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint() . $requestParams, $this->getRequestHeaders(), $requestBody);
        $responseData = json_decode($httpResponse->getBody(), true);

        // if ($httpResponse->getStatusCode() < 200 || $httpResponse->getStatusCode() > 299) {
        //     throw new InvalidRequestException("Invalid request to the Flexi Cards API. Received status code '{$httpResponse->getStatusCode()}'.");
        // }

        return $this->makeResponse($responseData);
    }
}
