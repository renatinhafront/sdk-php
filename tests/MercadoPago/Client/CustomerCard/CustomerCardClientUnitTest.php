<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * CustomerCardClient unit tests.
 */
final class CustomerCardClientUnitTest extends TestCase
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 201);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $customer_card = $client->create($customer_id, $this->createRequest());
        $this->assertEquals(201, $customer_card->getResponse()->getStatusCode());
        $this->assertEquals(1562188766852, $customer_card->id);
        $this->assertEquals(6, $customer_card->expiration_month);
        $this->assertEquals("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertEquals("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertEquals("CPF", $customer_card->cardholder->identification->type);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 201);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $card_id = "1562188766852";
        $customer_card = $client->get($customer_id, $card_id);
        $this->assertEquals(201, $customer_card->getResponse()->getStatusCode());
        $this->assertEquals(1562188766852, $customer_card->id);
        $this->assertEquals(6, $customer_card->expiration_month);
        $this->assertEquals("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertEquals("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertEquals("CPF", $customer_card->cardholder->identification->type);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 201);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $card_id = "1562188766852";
        $customer_card = $client->update($customer_id, $card_id, $this->createRequest());
        $this->assertEquals(201, $customer_card->getResponse()->getStatusCode());
        $this->assertEquals(1562188766852, $customer_card->id);
        $this->assertEquals(6, $customer_card->expiration_month);
        $this->assertEquals("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertEquals("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertEquals("CPF", $customer_card->cardholder->identification->type);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 201);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $card_id = "1562188766852";
        $customer_card = $client->delete($customer_id, $card_id);
        $this->assertEquals(201, $customer_card->getResponse()->getStatusCode());
        $this->assertEquals(1562188766852, $customer_card->id);
        $this->assertEquals(6, $customer_card->expiration_month);
        $this->assertEquals("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertEquals("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertEquals("CPF", $customer_card->cardholder->identification->type);
    }

    private function createRequest(): array
    {
        $request = [
            "token" => "60aca73f30e817fcf074cebc616897ba",
        ];
        return $request;
    }

    private function mockHttpRequest(string $filepath, int $status_code): \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest $mockHttpRequest */
        $mockHttpRequest = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();

        $responseJson = file_get_contents(__DIR__ . $filepath);
        $mockHttpRequest->method('execute')->willReturn($responseJson);
        $mockHttpRequest->method('getInfo')->willReturn($status_code);
        return $mockHttpRequest;
    }
}
