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
        $data['x_customer_ip'] = $this->getClientIp();
        $data['x_card_num'] = $this->getCard()->getNumber();
        $data['x_exp_date'] = $this->getCard()->getExpiryDate('my');
        $data['x_card_code'] = $this->getCard()->getCvv();
        $data['x_cust_id'] = $this->getCustomerId();

        if ($this->getTestMode()) {
            $data['x_test_request'] = 'TRUE';
        }

        return array_merge($data, $this->getBillingData());
    }
}
