<?php

namespace Kurtnoone\Xero\Resources;

use Kurtnoone\Xero\Facades\Xero;
use Illuminate\Support\Facades\Log;


class PurchaseOrders extends Xero
{
    public function get(int $page = null, string $where = null)
    {
        Log::info(
            'Xero PurchaseOrders Get: ' . PHP_EOL .
            'Page: ' . $page . PHP_EOL .
            'Where: ' . $where
        );
        $params = http_build_query([
            'page' => $page,
            'where' => $where
        ]);

        $result = Xero::get('PurchaseOrders?'.$params);

        Log::info('Xero PurchaseOrders Get Result: ' . json_encode($result));

        return $result['body']['PurchaseOrders'];
    }

    public function find(string $contactIds, string $statuses = null)
    {
        Log::info(
            'Xero PurchaseOrders Findx: ' . PHP_EOL .
            'IDs: ' . $contactIds . PHP_EOL .
            'Statuses: ' . $statuses
        );
        // https://api.xero.com/api.xro/2.0/PurchaseOrders?ContactIDs=a2aec9ec-4c33-4511-8bc0-ad851e8817e6&Statuses=AUTHORISED
        $params = [];

        if (!empty($contactIds)) {
            $params['ContactIDs'] = $contactIds;
        }

        if (!empty($statuses)) {
            $params['Statuses'] = $statuses;
        }

        $params = http_build_query($params);

        Log::info('Query Params' . $params);


        $result = Xero::get('PurchaseOrders?' . $params);

        return $result['body']['PurchaseOrders'];
    }

    public function onlineUrl(string $PurchaseOrderId)
    {
        $result = Xero::get('PurchaseOrders/'.$PurchaseOrderId.'/OnlinePurchaseOrder');

        return $result['body']['OnlinePurchaseOrders'][0]['OnlinePurchaseOrderUrl'];
    }

    public function update(string $PurchaseOrderId, array $data)
    {
        $result = Xero::post('PurchaseOrders/'.$PurchaseOrderId, $data);

        return $result['body']['PurchaseOrders'][0];
    }

    public function store(array $data)
    {
        $result = Xero::post('PurchaseOrders', $data);
        Log::info('Xero PurchaseOrders Store Result: '.json_encode($result));

        return $result['body']['PurchaseOrders'][0];
    }
}
