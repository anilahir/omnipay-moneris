<?php

namespace Omnipay\Moneris\Message;

class DeleteCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        $this->validate('cardReference');

        $request = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><request></request>');
        $request->addChild('store_id', $this->getMerchantId());
        $request->addChild('api_token', $this->getMerchantKey());

        $res_delete = $request->addChild('res_delete');
        $res_delete->addChild('data_key', $this->getCardReference());
        $data = $request->asXML();

        return preg_replace('/\n/', ' ', $data);
    }
}
