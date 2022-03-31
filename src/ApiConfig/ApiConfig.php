<?php

namespace Invertus\dpdBalticsApi\ApiConfig;

class ApiConfig
{
    const TEST_URLS = array(
        'EE' => 'https://ee.integration.dpd.eo.pl',
        'LV' => 'https://lv.integration.dpd.eo.pl',
        'LT' => 'https://lt.integration.dpd.eo.pl',
    );

    const LIVE_URLS = array(
        'EE' => 'https://integration.dpd.ee',
        'LV' => 'https://integration.dpd.lv',
        'LT' => 'https://integracijos.dpd.lt',
    );


    const SQ_PARCEL_SHOP_SEARCH = '/ws-mapper-rest/parcelShopSearch_';

    const SQ_SHIPMENT_CREATION = '/ws-mapper-rest/createShipment_';

    const SQ_PARCEL_PRINT = '/ws-mapper-rest/parcelPrint_';

    const SQ_CLOSING_MANIFEST = '/ws-mapper-rest/parcelManifestPrint_';

    const SQ_COURIER_REQUEST= '/ws-mapper-rest/pickupOrderSave_';

    const SQ_COLLECTION_REQUEST = '/ws-mapper-rest/crImport_';

    const VERSION = '1.0.0';
}
