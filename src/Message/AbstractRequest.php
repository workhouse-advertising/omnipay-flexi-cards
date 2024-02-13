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
        // TODO: Any specific headers that we need for this to function correctly? Or is their API down right now?
        return [
            // 'Accept' => 'application/json',
            // 'Content-Type' => 'application/json',
            // 'Content-Type' => 'application/x-www-form-urlencoded',
            // 'Content-Type' => 'text/plain',
        ];
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

        // NOTE: Provided example request body doesn't even work, is something missing? Headers?
        //       Is their API down or just broken?
        // $requestBody = '{"merchant_id": "12321","login_id":"203399","password":"Passwordaoeuaoeu01","api_key":"2bef9740cd0be5995e58f9eef3249cabbd65d4bc","merchant_transaction_id": "123","transaction_amount": 2000,"include_product_codes": {"product_code": ["6_MTHS","12_MTHS"]},"url_response": "https://www.google.co.nz","direct_to_url_response": "True","lineItems": {"lineItem": {"merchant_product_code": "S7","description": "Galaxy S7","quantity": "1","amount": "2000"}},"transmission_date_time": "20160909090990"}';

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint() . $requestParams, $this->getRequestHeaders(), $requestBody);
        $responseData = json_decode($httpResponse->getBody(), true);

        // if ($httpResponse->getStatusCode() < 200 || $httpResponse->getStatusCode() > 299) {
        //     throw new InvalidRequestException("Invalid request to the Flexi Cards API. Received status code '{$httpResponse->getStatusCode()}'.");
        // }

        return $this->makeResponse($responseData);
    }
}
