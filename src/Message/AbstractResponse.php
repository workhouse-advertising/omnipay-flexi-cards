<?php

namespace Omnipay\FlexiCards\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * TODO: Consider updating these messages so that they are more end-user friendly.
     *
     * @var array
     */
    protected $responseMessages = [
        '00' => 'ACCEPT_SUCCESSFUL: Flexi Cards web service request was successful.',
        '202' => 'NOT_VALID: Flexi Cards payment unavailable, possibly due to transaction value thresholds.',
        '203' => 'SYSTEM_ERROR: Unrecoverable error with the Flexi Cards payment gateway. If this issue persists please contact support.',
        '204' => 'INVALID_USER_DETAIL: Either the Flexi Cards username or password was incorrect.',
        '209' => 'ACCESS_NOT_ALLOWED: Either the Flexi Cards API key is invalid or the service has been disabled.',
        '257' => 'INVALID_PRODUCT_CODES: There are no applicable Flexi Cards product codes for the request.',
    ];

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        $code = (string) $this->getCode();
        return $this->responseMessages[$code] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->getResult()['resultCode'] ?? $this->getErrorDetails()['errorCode'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getCodeDescription()
    {
        return $this->getResult()['resultDesc'] ?? $this->getErrorDetails()['errorDesc'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getResult()
    {
        return $this->getData()['result'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getErrorDetails()
    {
        return $this->getData()['errorDetails'] ?? null;
    }
}
