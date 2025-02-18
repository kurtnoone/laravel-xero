<?php

namespace Kurtnoone\Xero\Resources;

use Kurtnoone\Xero\Facades\Xero;

class Accounts extends Xero
{
    public function get(int $page = null, string $where = null)
    {
        $params = http_build_query([
            'page' => $page,
            'where' => $where
        ]);

        $result = Xero::get('accounts?' . $params);

        // Ensure the 'Accounts' key exists
        if (isset($result['body']['Accounts'])) {
            return $result['body']['Accounts'];
        } else {
            // Handle the case where 'Accounts' key is not present
            // Log the unexpected response and return an empty array or throw an exception
            \Log::error('Unexpected Xero API response', ['response' => $result]);
            return [];
        }
    }

    public function find(string $accountId)
    {
        $result = Xero::get('accounts/' . $accountId);

        // Ensure the 'Accounts' key exists and has at least one element
        if (isset($result['body']['Accounts'][0])) {
            return $result['body']['Accounts'][0];
        } else {
            // Handle the case where 'Accounts' key is not present or empty
            \Log::error('Unexpected Xero API response', ['response' => $result]);
            return null;
        }
    }

    public function update(string $accountId, array $data)
    {
        $result = Xero::post('accounts/' . $accountId, $data);

        // Ensure the 'Accounts' key exists and has at least one element
        if (isset($result['body']['Accounts'][0])) {
            return $result['body']['Accounts'][0];
        } else {
            // Handle the case where 'Accounts' key is not present or empty
            \Log::error('Unexpected Xero API response', ['response' => $result]);
            return null;
        }
    }

    public function store(array $data)
    {
        $result = Xero::put('accounts', $data);

        // Ensure the 'Accounts' key exists and handle it properly
        if (isset($result['body']['Accounts'])) {
            if (is_array($result['body']['Accounts'])) {
                return $result['body']['Accounts'][0];
            } else {
                return $result['body']['Accounts'];
            }
        } else {
            // Handle the case where 'Accounts' key is not present
            \Log::error('Unexpected Xero API response', ['response' => $result]);
            return null;
        }
    }
}
