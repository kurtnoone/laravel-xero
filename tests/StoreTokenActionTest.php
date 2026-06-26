<?php

use Kurtnoone\Xero\Actions\StoreTokenAction;
use Kurtnoone\Xero\Models\XeroToken;

test('store token action persists scopes and tenant metadata', function () {
    $token = app(StoreTokenAction::class)(
        [
            'id_token' => 'id-token',
            'access_token' => 'access-token',
            'expires_in' => 1800,
            'token_type' => 'Bearer',
            'refresh_token' => 'refresh-token',
        ],
        [
            'auth_event_id' => 'auth-event',
            'tenant_id' => 'tenant-123',
            'tenant_type' => 'ORGANISATION',
            'tenant_name' => 'TradeFresh',
            'created_date_utc' => '2026-01-01T00:00:00.000Z',
            'updated_date_utc' => '2026-01-01T00:00:00.000Z',
        ],
        'tenant-123'
    );

    expect($token)->toBeInstanceOf(XeroToken::class);
    expect($token->scopes)->toBe(config('xero.scopes'));
    expect($token->expires_in)->toBe(1800);
    expect($token->token_type)->toBe('Bearer');
    expect($token->tenant_name)->toBe('TradeFresh');
    expect($token->tenant_id)->toBe('tenant-123');
});

test('store token action uses scope from token response when provided', function () {
    $token = app(StoreTokenAction::class)(
        [
            'id_token' => 'id-token',
            'access_token' => 'access-token',
            'expires_in' => 1800,
            'token_type' => 'Bearer',
            'refresh_token' => 'refresh-token',
            'scope' => 'openid email profile',
        ],
        [],
        'tenant-456'
    );

    expect($token->scopes)->toBe('openid email profile');
});
