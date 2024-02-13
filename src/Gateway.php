<?php

namespace Omnipay\FlexiCards;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
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
        return [];
    }
}
