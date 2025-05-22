<?php

namespace Kurtnoone\Xero\Console\Commands;

use Illuminate\Console\Command;
use Kurtnoone\Xero\Models\XeroToken;

class XeroKeepAliveCommand extends Command
{
    protected $signature = 'xero:keep-alive';

    protected $description = 'Keep the Xero token alive by refreshing it';

    public function handle()
    {
        $token = XeroToken::first();

        if (!$token) {
            $this->error('No Xero token found');
            return 1;
        }

        try {
            app('xero')->renewExpiringToken($token);
            $this->info('Token refreshed successfully');
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to refresh token: ' . $e->getMessage());
            return 1;
        }
    }
}
