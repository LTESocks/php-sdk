# LTESocks\ResidentialSubusersResource

Manage residential users under a reseller account.

All URIs are relative to https://api.ltesocks.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**changeTraffic()**](ResidentialSubusersResource.md#changeTraffic) | **POST** /proxies/residential/subusers/{childId}/traffic/{action} | Add, subtract, or reset traffic for the configured package |
| [**create()**](ResidentialSubusersResource.md#create) | **POST** /proxies/residential/subusers | Create a residential sub-user |
| [**delete()**](ResidentialSubusersResource.md#delete) | **DELETE** /proxies/residential/subusers/{childId} | Delete a residential sub-user |
| [**get()**](ResidentialSubusersResource.md#get) | **GET** /proxies/residential/subusers/{childId} | Get a residential sub-user |
| [**getCredentials()**](ResidentialSubusersResource.md#getCredentials) | **GET** /proxies/residential/subusers/{childId}/credentials | Retrieve residential proxy credentials |
| [**getPackage()**](ResidentialSubusersResource.md#getPackage) | **GET** /proxies/residential/subusers/{childId}/package | Get package and traffic allocation |
| [**list()**](ResidentialSubusersResource.md#list) | **GET** /proxies/residential/subusers | List residential sub-users |
| [**update()**](ResidentialSubusersResource.md#update) | **PATCH** /proxies/residential/subusers/{childId} | Update sub-user details and access rules |


## `changeTraffic()`

```php
changeTraffic($childId, $action, $idempotencyKey, $changeResidentialSubuserTrafficRequest): \LTESocks\Dto\ResidentialSubuserResponse
```

Add, subtract, or reset traffic for the configured package

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$childId = 'childId_example'; // string
$action = 'action_example'; // string
$idempotencyKey = 'idempotencyKey_example'; // string | Stable request key; reuse only for a retry of the same operation.
$changeResidentialSubuserTrafficRequest = new \LTESocks\Dto\ChangeResidentialSubuserTrafficRequest(); // \LTESocks\Dto\ChangeResidentialSubuserTrafficRequest

try {
    $result = $apiInstance->changeTraffic($childId, $action, $idempotencyKey, $changeResidentialSubuserTrafficRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->changeTraffic: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **childId** | **string**|  | |
| **action** | **string**|  | |
| **idempotencyKey** | **string**| Stable request key; reuse only for a retry of the same operation. | |
| **changeResidentialSubuserTrafficRequest** | [**\LTESocks\Dto\ChangeResidentialSubuserTrafficRequest**](../Model/ChangeResidentialSubuserTrafficRequest.md)|  | |

### Return type

[**\LTESocks\Dto\ResidentialSubuserResponse**](../Model/ResidentialSubuserResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `create()`

```php
create($idempotencyKey, $createResidentialSubuser): \LTESocks\Dto\ResidentialSubuserResponse
```

Create a residential sub-user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$idempotencyKey = 'idempotencyKey_example'; // string | Stable request key; reuse only for a retry of the same operation.
$createResidentialSubuser = new \LTESocks\Dto\CreateResidentialSubuser(); // \LTESocks\Dto\CreateResidentialSubuser

try {
    $result = $apiInstance->create($idempotencyKey, $createResidentialSubuser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->create: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **idempotencyKey** | **string**| Stable request key; reuse only for a retry of the same operation. | |
| **createResidentialSubuser** | [**\LTESocks\Dto\CreateResidentialSubuser**](../Model/CreateResidentialSubuser.md)|  | |

### Return type

[**\LTESocks\Dto\ResidentialSubuserResponse**](../Model/ResidentialSubuserResponse.md)

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
delete($childId, $idempotencyKey)
```

Delete a residential sub-user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$childId = 'childId_example'; // string
$idempotencyKey = 'idempotencyKey_example'; // string | Stable request key; reuse only for a retry of the same operation.

try {
    $apiInstance->delete($childId, $idempotencyKey);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **childId** | **string**|  | |
| **idempotencyKey** | **string**| Stable request key; reuse only for a retry of the same operation. | |

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

## `get()`

```php
get($childId): \LTESocks\Dto\ResidentialSubuserResponse
```

Get a residential sub-user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$childId = 'childId_example'; // string

try {
    $result = $apiInstance->get($childId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **childId** | **string**|  | |

### Return type

[**\LTESocks\Dto\ResidentialSubuserResponse**](../Model/ResidentialSubuserResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCredentials()`

```php
getCredentials($childId): \LTESocks\Dto\ResidentialCredentialsResponse
```

Retrieve residential proxy credentials

Returns the proxy password only on this explicit request.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$childId = 'childId_example'; // string

try {
    $result = $apiInstance->getCredentials($childId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->getCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **childId** | **string**|  | |

### Return type

[**\LTESocks\Dto\ResidentialCredentialsResponse**](../Model/ResidentialCredentialsResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPackage()`

```php
getPackage($childId): \LTESocks\Dto\ResidentialPackageResponse
```

Get package and traffic allocation

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$childId = 'childId_example'; // string

try {
    $result = $apiInstance->getPackage($childId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->getPackage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **childId** | **string**|  | |

### Return type

[**\LTESocks\Dto\ResidentialPackageResponse**](../Model/ResidentialPackageResponse.md)

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
list(): \LTESocks\Dto\ResidentialSubuserListResponse
```

List residential sub-users

Requires a Master account linked to a ProxyRequest reseller.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->list();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\LTESocks\Dto\ResidentialSubuserListResponse**](../Model/ResidentialSubuserListResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `update()`

```php
update($childId, $updateResidentialSubuser): \LTESocks\Dto\ResidentialSubuserResponse
```

Update sub-user details and access rules

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new LTESocks\Api\ResidentialSubusersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$childId = 'childId_example'; // string
$updateResidentialSubuser = new \LTESocks\Dto\UpdateResidentialSubuser(); // \LTESocks\Dto\UpdateResidentialSubuser

try {
    $result = $apiInstance->update($childId, $updateResidentialSubuser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResidentialSubusersResource->update: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **childId** | **string**|  | |
| **updateResidentialSubuser** | [**\LTESocks\Dto\UpdateResidentialSubuser**](../Model/UpdateResidentialSubuser.md)|  | |

### Return type

[**\LTESocks\Dto\ResidentialSubuserResponse**](../Model/ResidentialSubuserResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
