# LTESocks\UserResource

Read the current account and update its preferences.

All URIs are relative to https://api.ltesocks.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**get()**](UserResource.md#get) | **GET** /user | Get the current user |
| [**updatePreferences()**](UserResource.md#updatePreferences) | **POST** /user/preferences | Update user preferences |


## `get()`

```php
get(): \LTESocks\Dto\User
```

Get the current user

Returns the account associated with the bearer token, including preferences and account status.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\UserResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->get();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePreferences()`

```php
updatePreferences($userPreferences, $idempotencyKey): \LTESocks\Dto\User
```

Update user preferences

Updates supported preferences for the current account and returns the updated user object.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\UserResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userPreferences = new \LTESocks\Dto\UserPreferences(); // \LTESocks\Dto\UserPreferences | User preferences object
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->updatePreferences($userPreferences, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserResource->updatePreferences: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userPreferences** | [**\LTESocks\Dto\UserPreferences**](../Model/UserPreferences.md)| User preferences object | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
