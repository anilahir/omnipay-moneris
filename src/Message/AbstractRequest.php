<?php

namespace  Omnipay\Moneris\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $host = 'https://www3.moneris.com:443/gateway2/servlet/MpgRequest';
    protected $testHost = 'https://esqa.moneris.com:443/gateway2/servlet/MpgRequest';
    protected $endpoint = '';

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testHost : $this->host;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
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
        return $this->getParameter('payment_method');
    }

    public function setPaymentMethod($value)
    {
        return $this->setParameter('payment_method', $value);
    }

    public function getPaymentProfile()
    {
        return $this->getParameter('payment_profile');
    }

    public function setPaymentProfile($value)
    {
        return $this->setParameter('payment_profile', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('order_number');
    }

    public function setOrderNumber($value)
    {
        return $this->setParameter('order_number', $value);
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        // Don't throe exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        if(!empty($data)) {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                null,
                $data
            );
        }
        else {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint()
            );
        }

        $httpResponse = $httpRequest
            ->setHeader(
                'Content-Type',
                'application/xml'
            )
            ->send();

        $response = $httpResponse->getBody();

        $xmlResponse = simplexml_load_string($response);

        return $this->response = new Response($this, $xmlResponse);
    }
}

