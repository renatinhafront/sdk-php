<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\CustomerCard;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing card actions. */
class CustomerCardClient extends MercadoPagoClient
{
    private static $URL_WITH_CUSTOMER_ID = "/v1/customers/%s/cards"; 

    private static $URL_WITH_ID = "/v1/customers/%s/cards/%s";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for save CustomerCard.
     * @param string $id customer id.
     * @param array $request Customer Card data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard save.
     */
    public function create(string $id, array $request, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_CUSTOMER_ID, strval($id)), HttpMethod::POST, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting CustomerCard.
     * @param int $id customer id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     */
    public function getByCustomerId(int $customer_id, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_CUSTOMER_ID, strval($customer_id)), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting CustomerCard.
     * @param string $customer_id customer id.
     * @param string $id CustomerCard id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     */
    public function get(string $customer_id, string $id, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID,$customer_id, $id), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for update CustomerCard.
     * @param string $customer_id customer id.
     * @param string $id Card id.
     * @param array $request CustomerCard data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard update.
     */
    public function update(string $customer_id, string $id, array $request, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID,$customer_id, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for CustomerCard deletion.
     * @param string $customer_id customer id.
     * @param string $id Card id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     */
    public function delete(string $customer_id, string $id, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $customer_id, $id), HttpMethod::DELETE, null, null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}