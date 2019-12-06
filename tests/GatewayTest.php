<?php

namespace Omnipay\Moneris\Tests;

use Omnipay\Moneris\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $gateway;

    protected function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function test_create_card_success()
    {
        $this->setMockHttpResponse('CreateCardSuccess.txt');

        $response = $this->gateway->createCard([
            'card' => $this->getValidCard() + ['email' => 'user@example.com'],
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_create_card_failed()
    {
        $this->setMockHttpResponse('CreateCardFailure.txt');

        $response = $this->gateway->createCard([
            'card' => $this->getValidCard() + ['email' => 'user@example.com'],
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }

    public function test_delete_card_success()
    {
        $this->setMockHttpResponse('DeleteCardSuccess.txt');

        $response = $this->gateway->deleteCard([
            'cardReference' => '1234567890',
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_delete_card_failed()
    {
        $this->setMockHttpResponse('DeleteCardFailure.txt');

        $response = $this->gateway->deleteCard([
            'cardReference' => '1234567890',
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }

    public function test_authorize_success()
    {
        $this->setMockHttpResponse('AuthorizeSuccess.txt');

        $response = $this->gateway->authorize([
            'orderNumber'   => 'XXXX-XXXX',
            'paymentMethod' => 'payment_profile',
            'cardReference' => '1234567890',
            'amount'        => 5.00,
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_authorize_failed()
    {
        $this->setMockHttpResponse('AuthorizeFailure.txt');

        $response = $this->gateway->authorize([
            'orderNumber'   => 'XXXX-XXXX',
            'paymentMethod' => 'payment_profile',
            'cardReference' => '1234567890',
            'amount'        => 5.00,
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }

    public function test_capture_success()
    {
        $this->setMockHttpResponse('CaptureSuccess.txt');

        $response = $this->gateway->capture([
            'transactionReference' => '<?xml version="1.0" standalone="yes"?><response></response>',
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_capture_failed()
    {
        $this->setMockHttpResponse('CaptureFailure.txt');

        $response = $this->gateway->capture([
            'transactionReference' => '<?xml version="1.0" standalone="yes"?><response></response>',
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }

    public function test_purchase_success()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase([
            'orderNumber'   => 'XXXX-XXXX',
            'paymentMethod' => 'payment_profile',
            'cardReference' => '1234567890',
            'amount'        => 5.00,
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_purchase_failed()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->purchase([
            'orderNumber'   => 'XXXX-XXXX',
            'paymentMethod' => 'payment_profile',
            'cardReference' => '1234567890',
            'amount'        => 5.00,
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }

    public function test_refund_success()
    {
        $this->setMockHttpResponse('RefundSuccess.txt');

        $response = $this->gateway->refund([
            'amount'               => 5.00,
            'transactionReference' => '<?xml version="1.0" standalone="yes"?><response></response>',
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function test_refund_failed()
    {
        $this->setMockHttpResponse('RefundFailure.txt');

        $response = $this->gateway->refund([
            'amount'               => 5.00,
            'transactionReference' => '<?xml version="1.0" standalone="yes"?><response></response>',
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }

    public function test_invalid_api_response()
    {
        $this->setMockHttpResponse('InvalidApiResponse.txt');

        $response = $this->gateway->refund([
            'amount'               => 5.00,
            'transactionReference' => '<?xml version="1.0" standalone="yes"?><response></response>',
        ])->send();

        $this->assertFalse($response->isSuccessful());
    }
}
