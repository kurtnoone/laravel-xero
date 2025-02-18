<?php

namespace Kurtnoone\Xero\Resources;

use Kurtnoone\Xero\Facades\Xero;
use Illuminate\Support\Facades\Log;

class Payments extends Xero
{
    public function get(int $page = null, string $where = null)
    {
        $params = http_build_query([
            'page' => $page,
            'where' => $where
        ]);

        $result = Xero::get('payments?'.$params);

        return $result['body']['Payments'];
    }

    public function find(string $contactId)
    {
        $result = Xero::get('payments/'.$contactId);

        return $result['body']['Payments'][0];
    }

    public function onlineUrl(string $paymentId)
    {
        $result = Xero::get('payments/'.$paymentId.'/OnlinePayment');

        return $result['body']['OnlinePayments'][0]['OnlinePaymentUrl'];
    }

    public function update(string $paymentId, array $data)
    {
        $result = Xero::post('payments/'.$paymentId, $data);

        return $result['body']['Payments'][0];
    }

    public function store(array $data)
    {
        Log::info('Xero Payments Store: '.json_encode($data));
        $result = Xero::post('payments', $data);

        return $result['body']['Payments'][0];
    }
}
