<?php

namespace Omnipay\Moneris\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;

        $this->validate('amount');

        $paymentMethod = $this->getPaymentMethod();

        switch ($paymentMethod)
        {
            case 'card' :
                break;

            case 'payment_profile' :

                if ($this->getCardReference()) {

                    $request = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><request></request>');
                    $request->addChild('store_id', $this->getMerchantId());
                    $request->addChild('api_token', $this->getMerchantKey());

                    $res_purchase_cc = $request->addChild('res_purchase_cc');
                    $res_purchase_cc->addChild('data_key', $this->getCardReference());
                    $res_purchase_cc->addChild('order_id', $this->getOrderNumber());
                    $res_purchase_cc->addChild('cust_id', 'Transaction_' . $this->getOrderNumber());
                    $res_purchase_cc->addChild('amount', $this->getAmount());
                    $res_purchase_cc->addChild('crypt_type', 1);

                    $data = $request->asXML();
                }
                break;

            case 'token' :
                break;
            default :
                break;
        }

        return preg_replace('/\n/', ' ', $data);
    }
}

