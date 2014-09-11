<?php

namespace Omnipay\Ogone;

use Omnipay\Common\AbstractGateway;
use Omnipay\Ogone\Message\AuthorizeRequest;


/**
 * OGone Class
 * http://payment-services.ingenico.com/ogone/support/guides/integration%20guides/e-commerce
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
            'pspId' => '',
            /** Removed for now
            'currencyCode' => 'USD',
            'language' => 'en_US',
            **/
            'secret_code' => '',
            'testMode' => false,
        );
    }

    public function getPspId()
    {
        return $this->getParameter('pspId');
    }

    public function setPspId($value)
    {
        return $this->setParameter('pspId', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function getSecretCode()
    {
        return $this->getParameter('secret_code');
    }

    public function setSecretCode($value)
    {
        return $this->setParameter('secret_code', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Ogone\Message\AuthorizeRequest', $parameters);
    }

}
