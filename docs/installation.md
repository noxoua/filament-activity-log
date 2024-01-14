---
title: Installation
permalink: /installation
nav_order: 2
---

# Installation

____

{: .highlight }
This package works with spatie, make sure you have already installed [`spatie/laravel-activitylog`](https://github.com/spatie/laravel-activitylog)

{: .highlight }
Requires PHP 8.0 and Filament 3.0+

```bash
composer require noxoua/filament-activity-log
```

Optionally, you can publish the `config` file with:

```bash
php artisan vendor:publish --tag="filament-activity-log-config"
```

Optionally, you can publish the `views` file with:

```bash
php artisan vendor:publish --tag="filament-activity-log-views"
```

Optionally, you can publish the `translations` file with:

```bash
php artisan vendor:publish --tag="filament-activity-log-translations"
```
