<?php

namespace Omnipay\Moneris\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        $card = $this->getCard();

        if ($card) {
            $card->validate();
            $request = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><request></request>');
            $request->addChild('store_id', $this->getMerchantId());
            $request->addChild('api_token', $this->getMerchantKey());

            $res_add_cc = $request->addChild('res_add_cc');
            $res_add_cc->addChild('cust_id', $card->getBillingName());
            $phone = $card->getBillingPhone() != '' ? $card->getBillingPhone() : 'NA';
            $res_add_cc->addChild('phone', $phone);
            $res_add_cc->addChild('email', $card->getEmail());
            $res_add_cc->addChild('note', 'NA');
            $res_add_cc->addChild('pan', $card->getNumber());
            $res_add_cc->addChild('expdate', $card->getExpiryDate('my'));
            $res_add_cc->addChild('crypt_type', 1);

            $avs_info = $res_add_cc->addChild('avs_info');
            $avs_info->addChild('avs_street_number', 'NA');
            $avs_street_name = $card->getBillingAddress1() != '' ? $card->getBillingAddress1() : 'NA';
            $avs_info->addChild('avs_street_name', $avs_street_name);
            $avs_info->addChild('avs_zipcode', $card->getBillingPostcode());

            $data = $request->asXML();
        }

        return preg_replace('/\n/', '', $data);
    }
}
