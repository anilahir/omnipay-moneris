<?php

namespace Omnipay\Moneris\Tests\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Moneris\Message\CaptureRequest;
use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        parent::setUp();

        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function test_an_invalid_transaction_reference_should_throw_an_exception_for_the_capture_request()
    {
        $this->request->initialize([
            'transactionReference' => 'test',
        ]);

        try {
            $this->request->send();
        } catch (InvalidRequestException $e) {
            $this->assertEquals('test', $this->request->getTransactionReference());

            return;
        }

        $this->fail('Capture with an invalid transaction reference did not throw an InvalidRequestException.');
    }
}
