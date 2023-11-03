---
title: Installation
nav_order: 2
---

# Installation

## Install via Composer
____

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

## Adding Activity Page
____

Create a page in your pages folder `app/Filament/Pages/` and extends the `ListActivities` class.

```php
<?php

namespace App\Filament\Pages;

use Noxo\FilamentActivityLog\Pages\ListActivities;

class Activities extends ListActivities
{
    //
}
```
