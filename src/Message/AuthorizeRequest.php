<?php

namespace Omnipay\Ogone\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * OGone Authorize Request
 */
class AuthorizeRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://secure.ogone.com/ncol/prod/orderstandard(_utf8).asp';
    protected $developerEndpoint = 'https://secure.ogone.com/ncol/test/orderstandard(_utf8).asp';

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

    public function getData()
    {
        $this->validate('amount', 'returnUrl');

        $data = array();
        $data['PSPID'] = $this->getPspId();
        $data['ORDERID'] = $this->getTransactionId();
        $data['AMOUNT'] = $this->getAmount() * 100;
        $data['CURRENCY'] = $this->getCurrency();
        $data['CN'] = $this->getName();
        $data['EMAIL'] = $this->getEmail();
        $data['OWNERADDRESS'] = $this->getAddress1();
        $data['OWNERZIP'] = $this->getPostcode();
        $data['OWNERTOWN'] = $this->getCity();
        $data['OWNERCTY'] = $this->getCountry();
        $data['OWNERTELNO'] = $this->getPhone();

        /*
         * Generate Security Hash
         * http://payment-services.ingenico.com/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
        */
        if ($this->getSecretCode()) {
            $data['SHASIGN'] = sha1('AMOUNT='.$data['AMOUNT'].$this->getSecretCode().
                               'CURRENCY='.$data['CURRENCY'].$this->getSecretCode().
                               'LANGUAGE='.$data['LANGUAGE'].$this->getSecretCode().
                               'ORDERID='.$data['ORDERID'].$this->getSecretCode().
                               'PSPID='.$data['PSPID'].$this->getSecretCode());
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
