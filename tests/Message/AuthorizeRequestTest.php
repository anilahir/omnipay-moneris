<?php

namespace Omnipay\Moneris\Tests\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Moneris\Message\AuthorizeRequest;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function test_an_invalid_paymentMethod_should_throw_an_exception_for_the_authorize_request()
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

        $this->fail('Authorize with an invalid payment method did not throw an InvalidRequestException.');
    }
}
