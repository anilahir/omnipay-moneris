<?php

namespace Omnipay\Moneris\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        if ((
                (isset($this->data->receipt->Complete) && (bool) $this->data->receipt->Complete === true) ||
                (isset($this->data->receipt->ResSuccess) && (bool) $this->data->receipt->ResSuccess === true)
            ) &&
            (
                isset($this->data->receipt->ResponseCode) && $this->data->receipt->ResponseCode != 'null' &&
                (int) $this->data->receipt->ResponseCode >= 0 && (int) $this->data->receipt->ResponseCode <= 49
            )
        ) {
            return true;
        }

        return false;
    }

    public function getCardReference()
    {
        return isset($this->data->receipt->DataKey) ? (string) $this->data->receipt->DataKey : null;
    }

    public function getCode()
    {
        return isset($this->data->receipt->ResponseCode) ? (string) $this->data->receipt->ResponseCode : null;
    }

    public function getAuthCode()
    {
        return isset($this->data->receipt->AuthCode) ? (string) $this->data->receipt->AuthCode : null;
    }

    public function getTransactionId()
    {
        return isset($this->data->receipt->TransID) ? (string) $this->data->receipt->TransID : null;
    }

    public function getTransactionReference()
    {
        return isset($this->data->receipt->ReferenceNum) ? (string) $this->data->receipt->ReferenceNum : null;
    }

    public function getMessage()
    {
        return isset($this->data->receipt->Message) ? (string) $this->data->receipt->Message : null;
    }

    public function getOrderNumber()
    {
        return isset($this->data->receipt->ReceiptId) ? (string) $this->data->receipt->ReceiptId : null;
    }

    public function getData()
    {
        $response = null;

        try {
            $response = preg_replace('/\n/', '', ($this->data)->asXML());
        } catch (\Error $e) {
            $response = $this->data;
        }

        return $response;
    }
}
