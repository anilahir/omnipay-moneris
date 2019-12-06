<?php

namespace Omnipay\Moneris\Tests\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Moneris\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function test_an_invalid_payment_method_should_throw_an_exception_for_the_purchase_request()
    {
        $this->request->initialize([
            'orderNumber'   => 'XXXX-XXXX',
            'paymentMethod' => 'test',
            'cardReference' => 'FAKE_CARD_REFERENCE',
            'amount'        => 5.00,
        ]);

        try {
            $this->request->send();
        } catch (InvalidRequestException $e) {
            $this->assertEquals('test', $this->request->getPaymentMethod());

            return;
        }

        $this->fail('Purchase with an invalid payment method did not throw an InvalidRequestException.');
    }
}
