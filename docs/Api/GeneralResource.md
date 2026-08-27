# LTESocks\GeneralResource

Discover plans, servers, signatures, and token information.

All URIs are relative to https://api.ltesocks.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**listPlans()**](GeneralResource.md#listPlans) | **GET** /plans | List plans |
| [**listServers()**](GeneralResource.md#listServers) | **GET** /servers | List servers |
| [**listSignatures()**](GeneralResource.md#listSignatures) | **GET** /signatures | List signatures |


## `listPlans()`

```php
listPlans(): \LTESocks\Dto\ListPlans200Response
```

List plans

Returns the mobile proxy plans available to the current account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\GeneralResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listPlans();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GeneralResource->listPlans: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\ListPlans200Response**](../Model/ListPlans200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listServers()`

```php
listServers(): \LTESocks\Dto\ListServers200Response
```

List servers

Returns available proxy servers and their supported locations.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\GeneralResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listServers();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GeneralResource->listServers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\ListServers200Response**](../Model/ListServers200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSignatures()`

```php
listSignatures(): \LTESocks\Dto\ListSignatures200Response
```

List signatures

Returns mobile network signatures that can be selected when ordering or updating a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\GeneralResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listSignatures();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GeneralResource->listSignatures: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\ListSignatures200Response**](../Model/ListSignatures200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
