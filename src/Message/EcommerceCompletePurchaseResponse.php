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
        /*
         * Check if the Status is either 5/6/9
         */
        return isset($this->data['STATUS']) && str_replace(array(5,4,9), '', $this->data['STATUS']);
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
