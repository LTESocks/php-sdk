# LTESocks\PaymentsResource

Review account payments and create payment requests.

All URIs are relative to https://api.ltesocks.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**filter()**](PaymentsResource.md#filter) | **POST** /payments | Filter payments |
| [**list()**](PaymentsResource.md#list) | **GET** /payments | List payments |
| [**listCurrencies()**](PaymentsResource.md#listCurrencies) | **GET** /payments/currencies | List payment currencies |
| [**request()**](PaymentsResource.md#request) | **POST** /payments/request | Create a payment request |


## `filter()`

```php
filter($filterPortLogRequest): \LTESocks\Dto\ListPayments200Response
```

Filter payments

Returns payments using pagination and available filters.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PaymentsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$filterPortLogRequest = new \LTESocks\Dto\FilterPortLogRequest(); // \LTESocks\Dto\FilterPortLogRequest | Pagination parameters

try {
    $result = $apiInstance->filter($filterPortLogRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsResource->filter: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filterPortLogRequest** | [**\LTESocks\Dto\FilterPortLogRequest**](../Model/FilterPortLogRequest.md)| Pagination parameters | |

### Return type

[**\LTESocks\Dto\ListPayments200Response**](../Model/ListPayments200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `list()`

```php
list(): \LTESocks\Dto\ListPayments200Response
```

List payments

Returns the first page of payments for the current account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PaymentsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->list();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\ListPayments200Response**](../Model/ListPayments200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCurrencies()`

```php
listCurrencies()
```

List payment currencies

Reserved endpoint for payment currencies. The v2 contract currently marks this operation as under development.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PaymentsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $apiInstance->listCurrencies();
} catch (Exception $e) {
    echo 'Exception when calling PaymentsResource->listCurrencies: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `request()`

```php
request($requestPaymentRequest)
```

Create a payment request

Reserved endpoint for payment requests. The v2 contract currently marks this operation as under development.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PaymentsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$requestPaymentRequest = new \LTESocks\Dto\RequestPaymentRequest(); // \LTESocks\Dto\RequestPaymentRequest | Payment request parameters

try {
    $apiInstance->request($requestPaymentRequest);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsResource->request: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **requestPaymentRequest** | [**\LTESocks\Dto\RequestPaymentRequest**](../Model/RequestPaymentRequest.md)| Payment request parameters | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
