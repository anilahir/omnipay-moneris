<?php

namespace  Omnipay\Moneris\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public $testEndpoint = 'https://esqa.moneris.com:443/gateway2/servlet/MpgRequest';
    public $liveEndpoint = 'https://www3.moneris.com:443/gateway2/servlet/MpgRequest';

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    public function getPaymentMethod()
    {
        return $this->getParameter('paymentMethod');
    }

    public function setPaymentMethod($value)
    {
        return $this->setParameter('paymentMethod', $value);
    }

    public function getPaymentProfile()
    {
        return $this->getParameter('paymentProfile');
    }

    public function setPaymentProfile($value)
    {
        return $this->setParameter('paymentProfile', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    public function setOrderNumber($value)
    {
        return $this->setParameter('orderNumber', $value);
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        $headers = [
            'Content-Type' => 'application/xml',
        ];

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $data);

        try {
            $xmlResponse = simplexml_load_string($httpResponse->getBody()->getContents());
        } catch (\Exception $e) {
            $xmlResponse = (string) $httpResponse->getBody(true);
        }

        return $this->response = new Response($this, $xmlResponse);
    }
}
