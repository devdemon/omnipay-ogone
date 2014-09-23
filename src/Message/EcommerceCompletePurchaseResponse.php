<?php

namespace Omnipay\Ogone\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Ogone Complete Purchase Request
 */
class EcommerceCompletePurchaseResponse extends AbstractResponse
{

    public function isSuccessful()
    {
        return isset($this->data['STATUS']) && '5' === $this->data['STATUS'];
    }

    public function getTransactionReference()
    {
        return isset($this->data['ACCEPTANCE']) ? $this->data['ACCEPTANCE'] : null;
    }

    public function getStatus()
    {
        return isset($this->data['STATUS']) ? $this->data['STATUS'] : null;
    }

}
