# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.2.2] - 2023-03-03

- Fix Basic Authentication Middleware registration.

## [3.2.1] - 2022-11-28

- Minor changes to plugin documentation.
- Fix Migration file.

## [3.2.0] - 2022-09-23

### Added

- Basic Authentication added to October CMS backend routes.

### Removed

- Removed support for October CMS 1.0
- Removed support for PHP 7.4

## [3.1.0] - 2022-04-12

### Added

- Add October CMS 3.x to supported versions.

## [3.0.2] - 2022-03-22

### Changed

- Rename migration class (duplicate class name).

## [3.0.1] - 2022-03-15

- Update `october/system` version constraint.

## [3.0.0] - 2022-03-14

- !! Dropped logic for "Excluded URLs". Please add whitelisted paths after upgrading to this version.
- !! Passwords are now stored as hashed _values_ and you should change the passwords after upgrading.
- Add whitelisting for specific paths (two match types; `exact` and `starts_with`).
- Add composer requirement `october/system:>=1.0`.
- Old (plain text stored) password do still work.

## [2.1.0] - 2022-02-15

- Maintenance update:
  - Added `.gitattributes` files
  - Added composer/installers:^2.0 constraint to composer.json
  - Code (readability) improvements
  - Moved `Vdlp\BasicAuthentication\ServiceProvider` to `Vdlp\BasicAuthentication\ServiceProviders\BasicAuthenticationServiceProvider`
  - Moved boot logic from `Plugin` to its own middleware class `Vdlp\BasicAuthentication\Http\Middleware\BasicAuthenticationMiddleware`
  - Moved logic from AuthorizationHelper to `Vdlp\BasicAuthentication\Http\Middleware\BasicAuthenticationMiddleware`

## [2.0.0] - 2021-07-13

- Add support for PHP 7.4 and higher

## [1.2.0] - 2021-06-09

- Add console command for adding credentials

## [1.1.0] - 2021-05-28

- Add notification to settings view when basic authentication is disabled
