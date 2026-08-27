# PortPlan

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Plan ID | [optional]
**name** | **string** | Plan title | [optional]
**countryCode** | **string** | Plan country code | [optional]
**enabled** | **bool** | Indicates whether plan is active | [optional]
**autoRenew** | **bool** | Indicates whether plan auto renewal is active | [optional]
**activatedAt** | **\DateTime** | Plan activation time | [optional]
**expiresAt** | **\DateTime** | Plan expiration time | [optional]
**trafficRemains** | **int** | Remaining traffic amount in megabytes | [optional]
**tarification** | [**\LTESocks\Dto\PlanTarification**](PlanTarification.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
