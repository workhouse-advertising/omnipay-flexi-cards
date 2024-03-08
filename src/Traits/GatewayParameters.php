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
     * Get the value for the 'paymentStatusApiKey' parameter.
     *
     * @return mixed
     */
    public function getPaymentStatusApiKey()
    {
        return $this->getParameter('paymentStatusApiKey');
    }

    /**
     * Set the 'paymentStatusApiKey' parameter.
     *
     * @param $value
     * @return self
     */
    public function setPaymentStatusApiKey($value)
    {
        return $this->setParameter('paymentStatusApiKey', $value);
    }

    /**
     * Get the value for the 'paymentUrlApiKey' parameter.
     *
     * @return mixed
     */
    public function getPaymentUrlApiKey()
    {
        return $this->getParameter('paymentUrlApiKey');
    }

    /**
     * Set the 'paymentUrlApiKey' parameter.
     *
     * @param $value
     * @return self
     */
    public function setPaymentUrlApiKey($value)
    {
        return $this->setParameter('paymentUrlApiKey', $value);
    }
}
