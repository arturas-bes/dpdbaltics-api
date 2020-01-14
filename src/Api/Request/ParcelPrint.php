<?php

namespace Invertus\dpdBalticsApi\Api\Request;

use Exception;
use Invertus\dpdBalticsApi\Api\ApiRequest;
use Invertus\dpdBalticsApi\Api\DTO\Request\ParcelPrintRequest;
use Invertus\dpdBalticsApi\Api\DTO\Response\ParcelPrintResponse;
use Invertus\dpdBalticsApi\ApiConfig\DPDGroupApiConfig;
use Invertus\dpdBalticsApi\Factory\SerializerFactory;

class ParcelPrint
{

    /**
     * @var ApiRequest
     */
    private $apiRequest;

    /**
     * ParcelPrint constructor.
     * @param ApiRequest $apiRequest
     */
    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    /**
     * @param $request
     * @return mixed
     * @throws Exception
     */
    public function printParcel(ParcelPrintRequest $request)
    {
        $serializer = new SerializerFactory();
        $response = $this->apiRequest->post(
            DPDGroupApiConfig::SQ_PARCEL_PRINT,
            [
                'query' => $request->jsonSerialize(),
                'verify' => false,
            ]
        );
        $responseContent = $response->getBody()->getContents();
        $responseBody = $serializer->deserialize($responseContent, ParcelPrintResponse::class);

        if ($responseBody->getStatus() === null) {
            $responseBody->setStatus('ok');
            $responseBody->setErrLog('');
            $responseBody->setPdf($responseContent);
        }

        return $responseBody;
    }
}
