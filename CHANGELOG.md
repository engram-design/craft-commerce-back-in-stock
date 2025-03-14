# Changelog

## 4.0.7 - 2025-03-05

### Added
- Add `stockThreshold` plugin setting to control the minimum stock level to trigger notifications.

## 4.0.6 - 2025-02-03

### Fixed
- Fix log table “Product/Variant” using the Product Type cpEditUrl, instead of the individual Product/Variant cpEditUrl.

## 4.0.5 - 2024-12-31

### Fixed
- Fix an error related to plugin settings.

## 4.0.4 - 2024-12-14

### Added
- Add “From Name” and “From Email” plugin settings.

### Changed
- Email template plugin settings now support aliases and .env variables.

### Fixed
- Fix an issue for case-sensitive email checks.
- Fix an error when viewing logs.

## 4.0.3 - 2024-11-21

### Fixed
- Fix an error on Postgres installs.

## 4.0.2 - 2024-11-20

### Added
- Logs are now sortable.
- Logs can be searched.
- Logs are now lazy-loaded for performance.

### Changed
- Logs are now paginated.
- Logs are now listed newest first by default.

### Fixed
- Fix an error where checks for out of stock variants were being performed on unsaved variants.

## 4.0.1 - 2024-11-08

### Fixed
- Fix an error when adding an email with options.

## 4.0.0 - 2024-10-25

### Changed
- Now requires Craft 5.0+.
- Now requires Craft Commerce 5.0+.

## 3.0.7 - 2025-03-05

### Added
- Add `stockThreshold` plugin setting to control the minimum stock level to trigger notifications.

## 3.0.6 - 2025-02-03

### Fixed
- Fix log table “Product/Variant” using the Product Type cpEditUrl, instead of the individual Product/Variant cpEditUrl.

## 3.0.5 - 2024-12-31

### Fixed
- Fix an error related to plugin settings.

## 3.0.4 - 2024-12-14

### Added
- Add “From Name” and “From Email” plugin settings.

### Changed
- Email template plugin settings now support aliases and .env variables.

### Fixed
- Fix an issue for case-sensitive email checks.

## 3.0.3 - 2024-11-21

### Fixed
- Fix an error on Postgres installs.

## 3.0.2 - 2024-11-20

### Added
- Logs are now sortable.
- Logs can be searched.
- Logs are now lazy-loaded for performance.

### Changed
- Logs are now paginated.
- Logs are now listed newest first by default.

### Fixed
- Fix an error where checks for out of stock variants were being performed on unsaved variants.

## 3.0.1 - 2024-11-08

### Fixed
- Fix an error when adding an email with options.

## 3.0.0 - 2024-10-25
> {note} The plugin’s package name has changed to `verbb/back-in-stock`. Back in Stock will need be updated to 3.0 from a terminal, by running `composer require verbb/back-in-stock && composer remove mediabeastnz/craft-commerce-back-in-stock`.

### Changed
- Migration to `verbb/back-in-stock`.
- Now requires Craft 4.0+.
- Now requires Craft Commerce 4.0+.

## 2.1.1 - 2023-06-01

### Fixed
- Fixed issue - duplicate entries when options are supplied.

## 2.1.0 - 2022-07-10

### Added
- Ability to view customer submissions in the Control Panel.

## 2.0.0 - 2022-07-09

### Added
- Craft CMS and Commerce 4 support.

## 1.4.3 - 2022-07-09

### Fixed/Added
- Flash message is now set for those not using ajax to submit the form. The default message can be overwritten by using translations.

## 1.4.2 - 2022-07-09

### Added
- Added support for translating the subject line. This uses the customers locale and stores it in the database for later. This will require a migration so remember to run `craft migrate/all` if it is not already a part fo your deploy script. 

## 1.4.1 - 2022-07-09

### Fixed
- Fixed an issue with customers being able to subscribe multiple times (Issue #14)
- Fixed an issue with subject/preheader text not rendering correctly (Issue #9).

## 1.4.0 - 2020-05-27

### Added
- Confirmation emails can be sent to the customer now (Feature Request #6).
- Confirmation emails can use a custom template, subject line and is optional (off by default).

### Fixed
- Fixed an issue where duplicate records could be added resulting in multiple emails being sent.
- Tested on Craft 3.4 and Commerce 3.1.

## 1.3.1 - 2020-04-08

### Fixed
- Response from form can now be translated (Thanks @pieter-janDB)

## 1.3.0 - 2019-12-20

### Added
- You can now automatically purge user details after emails are sent. Useful if GDPR or similar is a requirement.

## 1.2.0 - 2019-12-19

### Fixed
- Email notifications are only fired once. An issue could of occured previously if the product had multiple variants and the user selected anything but the first variant. Thanks @jmauzyk.

## 1.1.0 - 2019-06-09

### Added
- Ability to store additional options e.g. product attributes etc (Thanks Josh Crawford)
- Responses are now ajax friendly
- Added response message for when email is already detected
 
### Fixed
- Validation issues when no email was entered and other various responses
- Creating a new product would cause an error as no variant was found, this is now fixed 

## 1.0.1 - 2019-05-30

### Changed
- Minor update to plugin icon

## 1.0.0 - 2019-05-19

### Added
- Initial release
