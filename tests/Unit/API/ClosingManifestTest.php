<?php

use Invertus\dpdBalticsApi\Api\DTO\Request\ClosingManifestRequest;
use Invertus\dpdBalticsApi\Api\DTO\Request\ShipmentCreationRequest;
use Invertus\dpdBalticsApi\Factory\APIRequest\ClosingManifestFactory;
use Invertus\dpdBalticsApi\Factory\APIRequest\ShipmentCreationFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class ClosingManifestTest extends TestCase
{

    public function testShipmentCreation()
    {
        $username = getenv('DPD_USERNAME');
        $password = getenv('DPD_PASSWORD');

        $requestBody = $this->createShipmentCreationRequest($username, $password);
        $shipmentCreationFactory = new ShipmentCreationFactory(new NullLogger());
        $shipmentCreator = $shipmentCreationFactory->makeShipmentCreation();
        $shipmentCreator->createShipment($requestBody);

        $requestBody = $this->createClosingManifestRequest($username, $password);
        $closingManifestFactory = new ClosingManifestFactory(new NullLogger());
        $closingManifest = $closingManifestFactory->makeClosingManifest();
        $responseBody = $closingManifest->closeManifest($requestBody);
        $this->assertEquals($responseBody->getStatus(), 'ok');
    }

    private function createClosingManifestRequest($username, $password)
    {
        $parcelPrintRequest = new ClosingManifestRequest(
            $username,
            $password,
            date('Y-m-d')
        );

        return $parcelPrintRequest;
    }

    private function createShipmentCreationRequest($username, $password)
    {
        $shipmentCreationRequest = new ShipmentCreationRequest(
            $username,
            $password,
            'testName',
            'testStreet',
            'testCity',
            'LV',
            '3003',
            1,
            'D-B2C',
            '123456',
            1
        );

        return $shipmentCreationRequest;
    }
}
