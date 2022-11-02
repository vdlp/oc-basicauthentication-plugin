# Vdlp.BasicAuthentication

Allows users to manage Basic Authentication credentials for multiple hostnames and environments.

## Requirements

* October CMS ^2.0
* PHP 8.0.2 or higher

## Installation

```
composer require vdlp/oc-basicauthentication-plugin
```

## Configuration

To configure this plugin execute the following command:

```
php artisan vendor:publish --provider="Vdlp\BasicAuthentication\ServiceProviders\BasicAuthenticationServiceProvider" --tag="config"
```

This will create a `config/basicauthentication.php` file in your app where you can modify the configuration if you don't want to use `.env` variables.

## Enable / disable plugin

> By default basic authentication is disabled.

To enable basic authentication, you have to set the env variable to `BASIC_AUTHENTICATION_ENABLED` to `true` in your `.env` file or edit the published config file.

## A Note On FastCGI

If you are using PHP FastCGI, HTTP Basic authentication may not work correctly out of the box. The following lines should be added to your `.htaccess` file:

```
RewriteCond %{HTTP:Authorization} ^(.+)$
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
```

## Questions? Need help?

If you have any question about how to use this plugin, please don't hesitate to contact us at octobercms@vdlp.nl. We're happy to help you.
