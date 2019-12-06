<?php

namespace Omnipay\Moneris\Tests\Message;

use Mockery;
use Omnipay\Moneris\Message\AbstractRequest;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        parent::setUp();

        $this->request = Mockery::mock(AbstractRequest::class)->makePartial();
    }

    public function test_get_data()
    {
        $this->request->initialize([
            'merchant_id'    => 'FAKE_MERCHANT_ID',
            'merchant_key'   => 'FAKE_MERCHANT_KEY',
            'orderNumber'    => 'DUMMY_ORDER_NUMBER',
            'paymentProfile' => 'FAKE_PAYMENT_PROFILE',
            'amount'         => 5.00,
            'cardReference'  => 'FAKE_CARD_REFERENCE',
        ]);

        $this->assertEquals('FAKE_MERCHANT_ID', $this->request->getMerchantId());
        $this->assertEquals('FAKE_MERCHANT_KEY', $this->request->getMerchantKey());
        $this->assertEquals('DUMMY_ORDER_NUMBER', $this->request->getOrderNumber());
        $this->assertEquals('FAKE_PAYMENT_PROFILE', $this->request->getPaymentProfile());
        $this->assertEquals(5.00, $this->request->getAmount());
        $this->assertEquals('FAKE_CARD_REFERENCE', $this->request->getCardReference());
    }
}
