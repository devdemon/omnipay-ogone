<?php

namespace Omnipay\Ogone\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * OGone Authorize Request
 */
class EcommercePurchaseRequest extends AbstractRequest
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

        if ($this->getCard()) {
            $data['CN'] = $this->getCard()->getName();
            $data['EMAIL'] = $this->getCard()->getEmail();
            $data['OWNERADDRESS'] = $this->getCard()->getAddress1();
            $data['OWNERZIP'] = $this->getCard()->getPostcode();
            $data['OWNERTOWN'] = $this->getCard()->getCity();
            $data['OWNERCTY'] = $this->getCard()->getCountry();
            $data['OWNERTELNO'] = $this->getCard()->getPhone();
        }

        /*
         * Generate Security Hash
         * http://payment-services.ingenico.com/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
        */
        if ($this->getSecretCode()) {
            $data['SHASIGN'] = sha1('AMOUNT='.$data['AMOUNT'].$this->getSecretCode().
                               /** Removed for now
                               'CURRENCY='.$data['CURRENCY'].$this->getSecretCode().
                               'LANGUAGE='.$data['LANGUAGE'].$this->getSecretCode().
                               **/
                               'CURRENCY=USD'.$this->getSecretCode().
                               'LANGUAGE=en_US'.$this->getSecretCode().
                               'ORDERID='.$data['ORDERID'].$this->getSecretCode().
                               'PSPID='.$data['PSPID'].$this->getSecretCode());
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new EcommercePurchaseResponse($this, $data);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
