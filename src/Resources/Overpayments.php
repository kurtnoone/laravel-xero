<?php

namespace Kurtnoone\Xero\Resources;

use Kurtnoone\Xero\Facades\Xero;
use Illuminate\Support\Facades\Log;

class Overpayments extends Xero
{
    public function get(int $page = null, string $where = null)
    {
        $params = http_build_query([
            'page' => $page,
            'where' => $where
        ]);

        $result = Xero::get('Overpayments?'.$params);

        Log::info('Xero Overpayments Get Result: '.json_encode($result));

        return $result['body']['Overpayments'];
    }

    public function find(string $contactId)
    {
        Log::info('Xero Overpayments Find: '.$contactId);
        $result = Xero::get('overpayments/'.$contactId);

        Log::info('Xero Overpayments Find Result: '.json_encode($result));

        if (isset($result['body']['Overpayments'])) {
            return $result['body']['Overpayments'];
        } else {
            return [];
        }
    }

    public function update(string $overpaymentId, array $data)
    {
        $result = Xero::post('overpayments/'.$overpaymentId, $data);

        Log::info('Xero Overpayments Update Result: '.json_encode($result));

        return $result['body']['Overpayments'][0];
    }

    public function store(array $data)
    {
        Log::info('Xero Overpayments Store: '.json_encode($data));
        $result = Xero::post('overpayments', $data);
        Log::info('Xero Overpayments Store Result: '.json_encode($result));

        return $result['body']['Overpayments'][0];
    }
}
