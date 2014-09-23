<?php

namespace Omnipay\Ogone\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Ogone Complete Purchase Request
 */
class EcommerceCompletePurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $callbackPW = (string) $this->httpRequest->request->get('callbackPW');
        if ($callbackPW !== $this->getCallbackPassword()) {
            throw new InvalidResponseException("Invalid callback password");
        }

        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

}
