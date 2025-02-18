<?php

namespace Kurtnoone\Xero\Resources;

use Kurtnoone\Xero\Facades\Xero;
use Illuminate\Support\Facades\Log;

class CreditNotes extends Xero
{
    public function get(int $page = null, string $where = null)
    {
        $params = http_build_query([
            'page' => $page,
            'where' => $where
        ]);

        $result = Xero::get('CreditNotes?'.$params);

        return $result['body']['CreditNotes'];
    }

    public function find(string $contactId)
    {
        $result = Xero::get('CreditNotes/'.$contactId);

        return $result['body']['CreditNotes'][0];
    }

    public function update(string $paymentId, array $data)
    {
        $result = Xero::post('CreditNotes/'.$paymentId, $data);

        return $result['body']['CreditNotes'][0];
    }

    public function store(array $data)
    {
        Log::info('Xero CreditNotes Store: '.json_encode($data));
        $result = Xero::post('CreditNotes', $data);
        Log::info('Xero CreditNotes Store Result: '.json_encode($result));

        return $result['body']['CreditNotes'][0];
    }
}
