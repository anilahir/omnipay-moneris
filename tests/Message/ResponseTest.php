<?php

namespace Omnipay\Moneris\Tests\Message;

use Omnipay\Moneris\Message\Response;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function test_success()
    {
        $data = simplexml_load_string('<?xml version="1.0"?>
                <response>
                    <receipt>
                        <DataKey>4Xch45n8c1CmvwGpaNnT1aLZ2</DataKey>
                        <ReceiptId>test11</ReceiptId>
                        <ReferenceNum>660160800016480070</ReferenceNum>
                        <ResponseCode>027</ResponseCode>
                        <ISO>01</ISO>
                        <AuthCode>839226</AuthCode>
                        <Message>APPROVED</Message>
                        <TransTime>08:03:45</TransTime>
                        <TransDate>2019-12-03</TransDate>
                        <TransType>00</TransType>
                        <Complete>true</Complete>
                        <TransAmount>2.00</TransAmount>
                        <CardType>V</CardType>
                        <TransID>20193-0_14</TransID>
                        <TimedOut>false</TimedOut>
                        <CorporateCard>false</CorporateCard>
                        <RecurSuccess>null</RecurSuccess>
                        <AvsResultCode>null</AvsResultCode>
                        <CvdResultCode>null</CvdResultCode>
                        <ResSuccess>true</ResSuccess>
                        <PaymentType>cc</PaymentType>
                        <IsVisaDebit>false</IsVisaDebit>
                        <ResolveData>
                            <cust_id>john doe</cust_id>
                            <phone>NA</phone>
                            <email>john.doe@example.com</email>
                            <note>NA</note>
                            <expdate>1220</expdate>
                            <masked_pan>4242***4242</masked_pan>
                            <crypt_type>1</crypt_type>
                            <avs_street_number>NA</avs_street_number>
                            <avs_street_name>NA</avs_street_name>
                            <avs_zipcode>395000</avs_zipcode>
                        </ResolveData>
                    </receipt>
                </response>');

        $response = new Response($this->getMockRequest(), $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('027', $response->getCode());
        $this->assertSame('APPROVED', $response->getMessage());
        $this->assertSame('20193-0_14', $response->getTransactionId());
        $this->assertSame('839226', $response->getAuthCode());
        $this->assertSame('660160800016480070', $response->getTransactionReference());
        $this->assertSame('test11', $response->getOrderNumber());
        $this->assertSame('4Xch45n8c1CmvwGpaNnT1aLZ2', $response->getCardReference());
    }

    public function test_empty()
    {
        $response = new Response($this->getMockRequest(), []);

        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getTransactionReference());
        $this->assertEmpty($response->getData());
    }
}
