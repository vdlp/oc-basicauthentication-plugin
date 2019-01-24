# Vdlp.BasicAuthentication

Allows users to manage Basic Authentication credentials for multiple hostnames and environments.

## Requirements

* PHP 7.1 or higher

## Installation

*CLI:*

```
php artisan plugin:install Vdlp.BasicAuthentication
```

*October CMS:*

Go to Settings > Updates & Plugins > Install plugins and search for 'BasicAuthentication'.

## Configuration

To configure this plugin execute the following command:

```
php artisan vendor:publish --provider="Vdlp\BasicAuthentication\ServiceProviders\BasicAuthenticationServiceProvider" --tag="config"
```

This will create a `config/basicauthentication.php` file in your app where you can modify the configuration if you don't
want to use .env variables.

## Questions? Need help?

If you have any question about how to use this plugin, please don't hesitate to contact us at octobercms@vdlp.nl. We're happy to help you. You can also visit the support forum and drop your questions/issues there.
