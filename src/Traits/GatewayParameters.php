<?php

namespace Omnipay\FlexiCards\Traits;

trait GatewayParameters
{
    /**
     * Get the value for the 'merchantId' parameter.
     *
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set the 'merchantId' parameter.
     *
     * @param $value
     * @return self
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * Get the value for the 'loginId' parameter.
     *
     * @return mixed
     */
    public function getLoginId()
    {
        return $this->getParameter('loginId');
    }

    /**
     * Set the 'loginId' parameter.
     *
     * @param $value
     * @return self
     */
    public function setLoginId($value)
    {
        return $this->setParameter('loginId', $value);
    }

    /**
     * Get the value for the 'password' parameter.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set the 'password' parameter.
     *
     * @param $value
     * @return self
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get the value for the 'apiKey' parameter.
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the 'apiKey' parameter.
     *
     * @param $value
     * @return self
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }
}
