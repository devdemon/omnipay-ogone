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
            'transactionKey' => '',
            'testMode' => false,
            'developerMode' => false,
        );
    }

    public function getApiLoginId()
    {
        return $this->getParameter('apiLoginId');
    }

    public function setApiLoginId($value)
    {
        return $this->setParameter('apiLoginId', $value);
    }

    public function getTransactionKey()
    {
        return $this->getParameter('transactionKey');
    }

    public function setTransactionKey($value)
    {
        return $this->setParameter('transactionKey', $value);
    }

    public function getDeveloperMode()
    {
        return $this->getParameter('developerMode');
    }

    public function setDeveloperMode($value)
    {
        return $this->setParameter('developerMode', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\OGone\Message\OGONEAuthorizeRequest', $parameters);
    }

}
