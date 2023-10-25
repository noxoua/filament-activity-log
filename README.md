# This is my package filament-activity-log

[![Latest Version on Packagist](https://img.shields.io/packagist/v/noxoua/filament-activity-log.svg?style=flat-square)](https://packagist.org/packages/noxoua/filament-activity-log)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/noxoua/filament-activity-log/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/noxoua/filament-activity-log/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/noxoua/filament-activity-log/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/noxoua/filament-activity-log/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/noxoua/filament-activity-log.svg?style=flat-square)](https://packagist.org/packages/noxoua/filament-activity-log)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require noxoua/filament-activity-log
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-activity-log-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-activity-log-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-activity-log-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentActivityLog = new Noxo\FilamentActivityLog();
echo $filamentActivityLog->echoPhrase('Hello, Noxo!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Noxo](https://github.com/noxoua)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
