<?php

namespace Kurtnoone\Xero\Tests;

use CreateXeroTokensTable;
use Kurtnoone\Xero\XeroServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            XeroServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        require_once dirname(__DIR__).'/src/database/migrations/create_xero_tokens_table.php';

        (new CreateXeroTokensTable)->up();
    }
}
