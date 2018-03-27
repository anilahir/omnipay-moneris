<?php

namespace Omnipay\Moneris\Message;

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'transactionReference');

        $transactionReference = simplexml_load_string($this->getTransactionReference());
        $transactionReceipt = $transactionReference->receipt;

        $request = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><request></request>');
        $request->addChild('store_id', $this->getMerchantId());
        $request->addChild('api_token', $this->getMerchantKey());

        $refund = $request->addChild('refund');
        $refund->addChild('order_id', $transactionReceipt->ReceiptId);
        $refund->addChild('amount', $this->getAmount());
        $refund->addChild('txn_number', $transactionReceipt->TransID);
        $refund->addChild('crypt_type', 1);
        $refund->addChild('cust_id', $transactionReceipt->ReferenceNum);
        $refund->addChild('dynamic_descriptor', 'Refund');

        $data = $request->asXML();

        return preg_replace('/\n/', ' ', $data);
    }
}
