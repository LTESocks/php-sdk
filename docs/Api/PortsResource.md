# LTESocks\PortsResource

Order, inspect, filter, and manage mobile proxy ports.

All URIs are relative to https://api.ltesocks.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**changePlan()**](PortsResource.md#changePlan) | **POST** /ports/{id}/plan | Change port plan |
| [**delete()**](PortsResource.md#delete) | **DELETE** /ports/{id} | Delete a port |
| [**deleteCompat()**](PortsResource.md#deleteCompat) | **POST** /ports/{id}/delete | Delete a port with POST |
| [**downloadVpn()**](PortsResource.md#downloadVpn) | **GET** /ports/{id}/vpn | Download VPN configuration |
| [**downloadVpnCompat()**](PortsResource.md#downloadVpnCompat) | **POST** /ports/{id}/vpn | Download VPN configuration with POST |
| [**extend()**](PortsResource.md#extend) | **POST** /ports/{id}/extend | Extend a port |
| [**filter()**](PortsResource.md#filter) | **POST** /ports | Filter ports |
| [**filterLog()**](PortsResource.md#filterLog) | **POST** /ports/{id}/log | Filter port log |
| [**get()**](PortsResource.md#get) | **GET** /ports/{id} | Get a port |
| [**getLog()**](PortsResource.md#getLog) | **GET** /ports/{id}/log | Get recent port log |
| [**list()**](PortsResource.md#list) | **GET** /ports | List ports |
| [**order()**](PortsResource.md#order) | **POST** /ports/order | Order a mobile port |
| [**reset()**](PortsResource.md#reset) | **POST** /ports/{id}/reset | Reset a port |
| [**resolveResetToken()**](PortsResource.md#resolveResetToken) | **GET** /tokens/{token} | Resolve a port reset token |
| [**setAutoRenew()**](PortsResource.md#setAutoRenew) | **POST** /ports/{id}/autorenew | Configure automatic renewal |
| [**setAutoResetInterval()**](PortsResource.md#setAutoResetInterval) | **POST** /ports/{id}/autoreset | Configure automatic reset |
| [**updateCredentials()**](PortsResource.md#updateCredentials) | **POST** /ports/{id}/credentials | Update proxy credentials |
| [**updateSignature()**](PortsResource.md#updateSignature) | **POST** /ports/{id}/signature | Change port signature |
| [**updateTags()**](PortsResource.md#updateTags) | **POST** /ports/{id}/tags | Update port tags |


## `changePlan()`

```php
changePlan($id, $orderPortsRequest, $idempotencyKey): \LTESocks\Dto\Port
```

Change port plan

Changes the billing plan assigned to a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$orderPortsRequest = new \LTESocks\Dto\OrderPortsRequest(); // \LTESocks\Dto\OrderPortsRequest | Plan parameters
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->changePlan($id, $orderPortsRequest, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->changePlan: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **orderPortsRequest** | [**\LTESocks\Dto\OrderPortsRequest**](../Model/OrderPortsRequest.md)| Plan parameters | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `delete()`

```php
delete($id)
```

Delete a port

Permanently removes a port from the current account. Use this operation only after confirming the identifier.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.

try {
    $apiInstance->delete($id);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |

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

## `deleteCompat()`

```php
deleteCompat($id)
```

Delete a port with POST

Compatibility endpoint that permanently removes a port using POST.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.

try {
    $apiInstance->deleteCompat($id);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->deleteCompat: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |

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

## `downloadVpn()`

```php
downloadVpn($id): \SplFileObject
```

Download VPN configuration

Downloads the VPN configuration archive associated with a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.

try {
    $result = $apiInstance->downloadVpn($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->downloadVpn: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |

### Return type

**\SplFileObject**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/octet-stream`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadVpnCompat()`

```php
downloadVpnCompat($id): \SplFileObject
```

Download VPN configuration with POST

Compatibility endpoint that downloads the VPN configuration archive using POST.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.

try {
    $result = $apiInstance->downloadVpnCompat($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->downloadVpnCompat: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |

### Return type

**\SplFileObject**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/octet-stream`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `extend()`

```php
extend($id, $idempotencyKey): \LTESocks\Dto\Port
```

Extend a port

Extends the active period of a port according to the selected plan.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->extend($id, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->extend: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `filter()`

```php
filter($filterPortsRequest): \LTESocks\Dto\ListPorts200Response
```

Filter ports

Returns a paginated list of ports filtered by plan, country, and tags.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$filterPortsRequest = new \LTESocks\Dto\FilterPortsRequest(); // \LTESocks\Dto\FilterPortsRequest | Pagination parameters

try {
    $result = $apiInstance->filter($filterPortsRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->filter: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filterPortsRequest** | [**\LTESocks\Dto\FilterPortsRequest**](../Model/FilterPortsRequest.md)| Pagination parameters | |

### Return type

[**\LTESocks\Dto\ListPorts200Response**](../Model/ListPorts200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `filterLog()`

```php
filterLog($id, $filterPortLogRequest): \LTESocks\Dto\GetPortLog200Response
```

Filter port log

Returns port events for a requested time range with pagination.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$filterPortLogRequest = new \LTESocks\Dto\FilterPortLogRequest(); // \LTESocks\Dto\FilterPortLogRequest | Pagination parameters

try {
    $result = $apiInstance->filterLog($id, $filterPortLogRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->filterLog: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **filterPortLogRequest** | [**\LTESocks\Dto\FilterPortLogRequest**](../Model/FilterPortLogRequest.md)| Pagination parameters | |

### Return type

[**\LTESocks\Dto\GetPortLog200Response**](../Model/GetPortLog200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `get()`

```php
get($id): \LTESocks\Dto\Port
```

Get a port

Returns one mobile proxy port by its account-scoped identifier.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.

try {
    $result = $apiInstance->get($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLog()`

```php
getLog($id): \LTESocks\Dto\GetPortLog200Response
```

Get recent port log

Returns the first page of connection and status events for a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.

try {
    $result = $apiInstance->getLog($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->getLog: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |

### Return type

[**\LTESocks\Dto\GetPortLog200Response**](../Model/GetPortLog200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `list()`

```php
list(): \LTESocks\Dto\ListPorts200Response
```

List ports

Returns the first page of mobile proxy ports owned by the current account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->list();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\ListPorts200Response**](../Model/ListPorts200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `order()`

```php
order($orderPortsRequest, $idempotencyKey): \LTESocks\Dto\Port
```

Order a mobile port

Creates a mobile proxy port using the selected plan and tarification.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$orderPortsRequest = new \LTESocks\Dto\OrderPortsRequest(); // \LTESocks\Dto\OrderPortsRequest | Plan parameters
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->order($orderPortsRequest, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->order: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **orderPortsRequest** | [**\LTESocks\Dto\OrderPortsRequest**](../Model/OrderPortsRequest.md)| Plan parameters | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `reset()`

```php
reset($id, $idempotencyKey): \LTESocks\Dto\Port
```

Reset a port

Requests an immediate mobile connection reset and IP rotation for a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->reset($id, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->reset: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resolveResetToken()`

```php
resolveResetToken($token): \LTESocks\Dto\Port
```

Resolve a port reset token

Returns the port associated with a port reset token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$token = 'token_example'; // string | Port reset token to resolve.

try {
    $result = $apiInstance->resolveResetToken($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->resolveResetToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **token** | **string**| Port reset token to resolve. | |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setAutoRenew()`

```php
setAutoRenew($id, $updatePortAutorenewRequest, $idempotencyKey): \LTESocks\Dto\Port
```

Configure automatic renewal

Enables or disables automatic renewal for a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$updatePortAutorenewRequest = new \LTESocks\Dto\UpdatePortAutorenewRequest(); // \LTESocks\Dto\UpdatePortAutorenewRequest | Autorenew parameters
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->setAutoRenew($id, $updatePortAutorenewRequest, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->setAutoRenew: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **updatePortAutorenewRequest** | [**\LTESocks\Dto\UpdatePortAutorenewRequest**](../Model/UpdatePortAutorenewRequest.md)| Autorenew parameters | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setAutoResetInterval()`

```php
setAutoResetInterval($id, $updatePortAutoresetRequest, $idempotencyKey): \LTESocks\Dto\Port
```

Configure automatic reset

Enables or disables scheduled automatic IP resets for a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$updatePortAutoresetRequest = new \LTESocks\Dto\UpdatePortAutoresetRequest(); // \LTESocks\Dto\UpdatePortAutoresetRequest | Auto reset interval parameters
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->setAutoResetInterval($id, $updatePortAutoresetRequest, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->setAutoResetInterval: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **updatePortAutoresetRequest** | [**\LTESocks\Dto\UpdatePortAutoresetRequest**](../Model/UpdatePortAutoresetRequest.md)| Auto reset interval parameters | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateCredentials()`

```php
updateCredentials($id, $portCredentials, $idempotencyKey): \LTESocks\Dto\Port
```

Update proxy credentials

Replaces the username and password used to connect to a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$portCredentials = new \LTESocks\Dto\PortCredentials(); // \LTESocks\Dto\PortCredentials | Credentials parameters
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->updateCredentials($id, $portCredentials, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->updateCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **portCredentials** | [**\LTESocks\Dto\PortCredentials**](../Model/PortCredentials.md)| Credentials parameters | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSignature()`

```php
updateSignature($id, $updatePortSignatureRequest, $idempotencyKey): \LTESocks\Dto\Port
```

Change port signature

Changes the mobile network signature assigned to a port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$updatePortSignatureRequest = new \LTESocks\Dto\UpdatePortSignatureRequest(); // \LTESocks\Dto\UpdatePortSignatureRequest | Signature parameters
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->updateSignature($id, $updatePortSignatureRequest, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->updateSignature: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **updatePortSignatureRequest** | [**\LTESocks\Dto\UpdatePortSignatureRequest**](../Model/UpdatePortSignatureRequest.md)| Signature parameters | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateTags()`

```php
updateTags($id, $updatePortTagsRequest, $idempotencyKey): \LTESocks\Dto\Port
```

Update port tags

Replaces the tags attached to a port. Tags are useful for grouping and filtering.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\PortsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Account-scoped port identifier.
$updatePortTagsRequest = new \LTESocks\Dto\UpdatePortTagsRequest(); // \LTESocks\Dto\UpdatePortTagsRequest | Tags
$idempotencyKey = 'idempotencyKey_example'; // string | Optional UUID that identifies one mutation request. Reuse it only when retrying the same request.

try {
    $result = $apiInstance->updateTags($id, $updatePortTagsRequest, $idempotencyKey);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PortsResource->updateTags: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Account-scoped port identifier. | |
| **updatePortTagsRequest** | [**\LTESocks\Dto\UpdatePortTagsRequest**](../Model/UpdatePortTagsRequest.md)| Tags | |
| **idempotencyKey** | **string**| Optional UUID that identifies one mutation request. Reuse it only when retrying the same request. | [optional] |

### Return type

[**\LTESocks\Dto\Port**](../Model/Port.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
