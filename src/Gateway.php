<?php

namespace Omnipay\Ogone;

use Omnipay\Common\AbstractGateway;
use Omnipay\Ogone\Message\AuthorizeRequest;


/**
 * OGone Class
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Ogone';
    }

    public function getDefaultParameters()
    {
        return array(
            'PSPID' => '',
            'testMode' => false,
        );
    }

    public function getApiLoginId()
    {
        return $this->getParameter('PSPID');
    }

    public function setApiLoginId($value)
    {
        return $this->setParameter('PSPID', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Ogone\Message\AuthorizeRequest', $parameters);
    }

}
