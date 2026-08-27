# Port

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**port** | **string** | Port number | [optional]
**ip** | **string** | Port current IP address (0.0.0.0 if not available) | [optional]
**geoip** | [**\LTESocks\Dto\GeoIP**](GeoIP.md) |  | [optional]
**status** | **string** | Port status | [optional]
**resetToken** | **string** | Port reset token | [optional]
**signature** | **string** | Port signature | [optional]
**vpnAccess** | **bool** | Indicates whether port has access to the VPN server | [optional]
**autoResetInterval** | **int** | Port auto reset interval in seconds, 0 means disabled | [optional]
**tags** | **string[]** | Port tags | [optional]
**plan** | [**\LTESocks\Dto\PortPlan**](PortPlan.md) |  | [optional]
**credentials** | [**\LTESocks\Dto\PortCredentials**](PortCredentials.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
