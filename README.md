# Phone2Action

A PHP package for working w/ the Phone2Action API.

## Install

Normal install via Composer.

## Usage

```php
use Travis\Phone2Action;

$api_id = 'your-api-id';
$api_key = 'your-api-key';

// get list of participants
$response = Phone2Action::run($api_id, $api_key, 'advocates', 'GET');
```

See the [API Guide](https://docs.phone2action.com/) for additional methods.