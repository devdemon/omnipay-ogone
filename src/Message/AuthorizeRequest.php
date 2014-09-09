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
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = array();
        $data['PSPID'] = $this->getApiLoginId();
        $data['ORDERID'] = $this->getOrderId();
        $data['AMOUNT'] = $this->getAmount();
        $data['CURRENCY'] = $this->getCurrency();
        $data['CN'] = $this->getCustomerName();
        $data['EMAIL'] = $this->getCustomerEmail();
        $data['OWNERZIP'] = $this->getCustomerZip();
        $data['OWNERADDRESS'] = $this->getCustomerAddress();
        $data['OWNERCITY'] = $this->getCustomerCity();
        $data['OWNERTOWN'] = $this->getCustomerTown();
        $data['OWNERTELNO'] = $this->getCustomerTelephone();

        $data['SHASIGN'] = sha1(implode(':', array($data['AMOUNT'],
                $data['CURRENCY'], $data['LANGUAGE'], $data['ORDERID'], $data['PSPID'])));

        return $data;
    }
}
