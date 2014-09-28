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
        $status = $this->httpRequest->query->get('STATUS');

        if (!$status) return false;

        /*
         * Check if the Status is either 5/6/9
         */
        return (str_replace(array(5,4,9), '', $status) == false);
    }

    public function getTransactionReference()
    {
        return $this->httpRequest->query->get('ACCEPTANCE');
    }
}