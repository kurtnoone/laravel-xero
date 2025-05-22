<?php

namespace Kurtnoone\Xero\Resources;

use Kurtnoone\Xero\Facades\Xero;
use Illuminate\Support\Facades\Log;

class BankTransactions
{
    public function get(int $page = null, string $where = null)
    {
        $params = http_build_query([
            'page' => $page,
            'where' => $where
        ]);

        $result = Xero::get('banktransactions?'.$params);

        return $result['body']['BankTransactions'];
    }

    // get bank transactions by id
    public function getId(string $banktransactionId)
    {
        $result = Xero::get('banktransactions/'.$banktransactionId);

        return $result['body']['BankTransactions'][0];
    }

    public function find(string $contactId)
    {
        $result = Xero::get('banktransactions/'.$contactId);

        return $result['body']['BankTransactions'][0];
    }

    public function update(string $banktransactionId, array $data)
    {
        $result = Xero::post('banktransactions/'.$banktransactionId, $data);

        return $result['body']['BankTransactions'][0];
    }

    public function store(array $data)
    {
        Log::info('Xero Banktransactions Store: '.json_encode($data));
        $result = Xero::post('banktransactions', $data);
        Log::info('Xero Banktransactions Store Result: '.json_encode($result));

        return $result['body']['BankTransactions'][0];
    }
}
