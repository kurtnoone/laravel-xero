# Changelog

All notable changes to `Laravel Xero` will be documented in this file.

## Version 1.0.0

- Everything

## Version 1.0.1

- changed id_token to be text

## Version 1.0.2

- all records by default and added raw option

## Version 1.0.3

- Add support for multiple tenant storing.

## Version 1.1.0

- only expect tenant id when tenantData is being used

## Version 1.1.1

- Add new command keep-alive

## Version 1.1.2

- Added command `xero:show-all` to show all tokens stored in the database.

## Version 1.1.3

- Update keep-alive for multi-tenant use, and storeToken where id when using tenant_id in the class

## Version 1.1.4

- Added support for Laravel 10

## Version 1.1.5

- applied fix for returning access token

## Version 1.1.6

- Update Xero.php expiry check to use the accessor instead of expired_in column
- Fixed failing test for getting access token

## Version 1.2.0

- Added cache lock around token refresh to prevent concurrent refresh races
- Improved structured Xero API error formatting and logging
- Added `storeMany()` batch support on invoices and credit notes
- TradeFresh resource and accounts helper updates

## Version 1.2.1

- Fixed OAuth token storage failing with "Field 'scopes' doesn't have a default value" by adding `expires_in`, `token_type`, and `scopes` to `XeroToken` mass assignment
- Merge tenant metadata when storing tokens during connect
- Fall back to the OAuth callback scope or configured scopes when the token response omits `scope`