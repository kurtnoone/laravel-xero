<?php

namespace Kurtnoone\Xero\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isConnected()
 * @method static void disconnect()
 * @method static mixed connect()
 * @method static string getAccessToken(bool $redirectWhenNotConnected = true)
 * @method static string getTenantId()
 * @method static string getTenantName()
 * @method static \Kurtnoone\Xero\Resources\Contacts contacts()
 * @method static \Kurtnoone\Xero\Resources\Invoices invoices()
 * @method static \Kurtnoone\Xero\Resources\Payments payments()
 * @method static \Kurtnoone\Xero\Resources\Overpayments overpayments()
 * @method static \Kurtnoone\Xero\Resources\BankTransactions banktransactions()
 * @method static \Kurtnoone\Xero\Resources\CreditNotes creditnotes()
 * @method static \Kurtnoone\Xero\Resources\PurchaseOrders purchaseorders()
 * @method static \Kurtnoone\Xero\Resources\Accounts accounts()
 * @method static \Kurtnoone\Xero\Resources\Webhooks webhooks()
 */
class Xero extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'xero';
    }
}
