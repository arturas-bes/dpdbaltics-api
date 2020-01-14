<?php

namespace Invertus\dpdBalticsApi\Api\Request;

use Exception;
use Invertus\dpdBalticsApi\Api\ApiRequest;
use Invertus\dpdBalticsApi\Api\DTO\Request\ClosingManifestRequest;
use Invertus\dpdBalticsApi\Api\DTO\Request\ParcelPrintRequest;
use Invertus\dpdBalticsApi\Api\DTO\Response\ClosingManifestResponse;
use Invertus\dpdBalticsApi\Api\DTO\Response\ParcelPrintResponse;
use Invertus\dpdBalticsApi\ApiConfig\DPDGroupApiConfig;
use Invertus\dpdBalticsApi\Factory\SerializerFactory;

class ClosingManifest
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
    public function closeManifest(ClosingManifestRequest $request)
    {
        $serializer = new SerializerFactory();
        $response = $this->apiRequest->post(
            DPDGroupApiConfig::SQ_CLOSING_MANIFEST,
            [
                'query' => $request->jsonSerialize(),
                'verify' => false,
            ]
        );
        $responseBody = $serializer->deserialize($response->getBody()->getContents(), ClosingManifestResponse::class);

        return $responseBody;
    }
}