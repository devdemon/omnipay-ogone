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

    public function getApiLoginId()
    {
        return $this->getParameter('pspId');
    }

    public function setApiLoginId($value)
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

    public function getData()
    {
        $this->validate('amount', 'returnUrl');

        $data = array();
        $data['PSPID'] = $this->getApiLoginId();
        $data['ORDERID'] = $this->getOrderId();
        $data['AMOUNT'] = $this->getAmount() * 100;
        $data['CURRENCY'] = $this->getCurrency();
        $data['CN'] = $this->getCustomerName();
        $data['EMAIL'] = $this->getCustomerEmail();
        $data['OWNERZIP'] = $this->getCustomerZip();
        $data['OWNERADDRESS'] = $this->getCustomerAddress();
        $data['OWNERCITY'] = $this->getCustomerCity();
        $data['OWNERTOWN'] = $this->getCustomerTown();
        $data['OWNERTELNO'] = $this->getCustomerTelephone();

        /*
         * Generate Security Hash
         * http://payment-services.ingenico.com/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
        */
        $data['SHASIGN'] = sha1('AMOUNT='.$data['AMOUNT'].$this->getSecretPass().
                           'CURRENCY='.$data['CURRENCY'].$this->getSecretPass().
                           'LANGUAGE='.$data['LANGUAGE'].$this->getSecretPass().
                           'ORDERID='.$data['ORDERID'].$this->getSecretPass().
                           'PSPID='.$data['PSPID'].$this->getSecretPass());

        return $data;
    }
}
