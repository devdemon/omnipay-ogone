<?php

namespace Omnipay\Ogone;

use Omnipay\Common\AbstractGateway;
use Omnipay\Ogone\Message\AuthorizeRequest;


/**
 * OGone Class
 * http://payment-services.ingenico.com/ogone/support/guides/integration%20guides/e-commerce
 */
class EcommerceGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Ogone - e-Commerce';
    }

    public function getDefaultParameters()
    {
        return array(
            'pspId' => '',
            'sha_in' => '',
            'sha_out' => '',
            'sha_algo' => 'sha1', // sha1, sha256, sha512
            'language' => 'en_US',
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

    public function getShaIn()
    {
        return $this->getParameter('sha_in');
    }

    public function setShaIn($value)
    {
        return $this->setParameter('sha_in', $value);
    }

    public function getShaOut()
    {
        return $this->getParameter('sha_out');
    }

    public function setShaOut($value)
    {
        return $this->setParameter('sha_out', $value);
    }

    public function getShaAlgo()
    {
        return $this->getParameter('sha_algo');
    }

    public function setShaAlgo($value)
    {
        return $this->setParameter('sha_algo', $value);
    }

    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Ogone\Message\EcommercePurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Ogone\Message\EcommerceCompletePurchaseRequest', $parameters);
    }
}
