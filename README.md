<div class="filament-hidden">

![header](https://raw.githubusercontent.com/noxoua/filament-activity-log/main/.github/resources/header.png)

# Filament Activity Log

[![Latest Version on Packagist](https://img.shields.io/packagist/v/noxoua/filament-activity-log.svg?include_prereleases)](https://packagist.org/packages/noxoua/filament-activity-log)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/noxoua/filament-activity-log/code-style.yml?branch=main&label=Code%20style&style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/noxoua/filament-activity-log.svg)](https://packagist.org/packages/noxoua/filament-activity-log)

* [Introduction](#introduction)
* [Installation](#installation)
* [Activities Page](#activities-page)
  - [Create a page](#create-a-page)
* [Loggers](#loggers)
  - [Create a Logger](#create-a-logger)
  - [Logger - Events](#logger---events)
  - [Logger - Fields](#logger---fields)
  - [Logger - Field Types](#logger---field-types)
  - [Logger - Field Value Views](#logger---field-value-views)
  - [Logger - Field Translated Keys](#logger---field-translated-keys)
  - [Logger - Usage with relations](#logger---usage-with-relations)
    - [Primary events](#primary-events)
    - [CreateRecord](#createrecord)
    - [EditRecord](#editrecord)
    - [Table actions](#table-actions)
* [Contributing](#contributing)
* [License](#license)

</div>

## Introduction

This package is an add-on for simplified activity logging based on [`spatie/laravel-activitylog`](https://github.com/spatie/laravel-activitylog) package. This package also includes a page for viewing activity logs.

The viewing page was copied from [`pxlrbt/filament-activity-log`](https://github.com/pxlrbt/filament-activity-log) package and slightly modernized. If you only need the page for viewing activity logs, without additional functionality, use this package - [`pxlrbt/filament-activity-log`](https://github.com/pxlrbt/filament-activity-log)


<div class="filament-hidden">

![Screenshot](https://raw.githubusercontent.com/noxoua/filament-activity-log/main/.github/resources/screenshot.png)

</div>

## Installation


Install via Composer.

**Requires PHP 8.0 and Filament 3.0+**

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


## Activities Page

### Create a page

Create a new page and extends the `ListActivities` class.

```php
<?php

namespace App\Filament\Pages;

use Noxo\FilamentActivityLog\Pages\ListActivities;

class Activities extends ListActivities
{
    //
}
```

## Loggers

### Create a Logger

Use the artisan command to create a logger.

```bash
php artisan make:filament-logger User
```
Result:
```bash
INFO  Filament logger [app/Filament/Loggers/UserLogger.php] created successfully.
```

Once `UserLogger` is created, it immediately starts listening to model events.

### Logger - Events

The Logger class has the `events` property, which is a list of events that will be logged automatically.


```php
public static ?array $events = [
    'created',
    'updated',
    'deleted',
    'restored',
];
```

### Logger - Fields

The Logger class has the `fields` property where you can specify all fields that need to be logged. You can also specify relations.


```php
public static ?array $fields = [
    'name',
    'email',
    'email_verified_at',
    'media', // <---- relation
    'roles', // <---- relation
];
```

### Logger - Field Types

The Logger class has the `types` property where you can specify fields and how they should be logged.

```php
public static ?array $types = [
    'email_verified_at' => 'datetime:Y-m-d', // format is optional
    'media' => 'media', // <---- spatie media-library
    'roles' => 'pluck:name', // <---- relation
];
```

Available types:
- date
- time
- datetime
- media | media:multiple
- boolean
- only:first_name,last_name
- pluck:first_name
- enum


### Logger - Field Value Views

The Logger class has the `views` property where you can define how to display specific fields in the activity log views.

```php
public static ?array $views = [
    'email_verified_at' => 'badge',
    'media' => 'avatar',
    'roles' => 'badge',
];
```

Available views:
- avatar
- image
- badge

___

<img src="https://raw.githubusercontent.com/noxoua/filament-activity-log/main/.github/resources/screenshot-views.png" width="750">

(Note: _"avatar" and "image" have the same size but a different border-radius._)


### Logger - Field Translated Keys

The Logger class has the `attributeMap` property where you can map field keys to make translations user-friendly.

```php
public static ?array $attributeMap = [
    'name' => 'first_name',
    'media' => 'avatar',
];
```

### Logger - Usage with relations

If you want to log relations as well, you should comment out the `created` and `updated` events and manually add a logger to your filament resource.

```php
public static ?array $events = [
    // 'created',
    // 'updated',
    'deleted',
    'restored',
];
```

#### Primary events

```php
// Created
UserLogger::make($record)->created();

// Updated
UserLogger::make($old_record, $new_record)->updated();

// Deleted
UserLogger::make($record)->deleted();

// Restored
UserLogger::make($record)->restored();
```

#### CreateRecord
```php

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function afterCreate()
    {
        UserLogger::make($this->record)->created();
    }
}

```

#### EditRecord

```php

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public $old_model;

    public function beforeValidate()
    {
        $this->old_model = clone $this->record->load('roles', 'media');
    }

    public function afterSave()
    {
        $new_model = $this->record->load('roles', 'media');
        UserLogger::make($this->old_model, $new_model)->updated();
    }
}

```


#### Table actions

```php

->actions([
    Tables\Actions\Action::make('verify_email')
        ->action(function ($record) {

            UserLogger::make($record)
                ->through(fn ($record) => $record->markEmailAsVerified())
                ->updated();

        }),
])

```

## Contributing

Please see [CONTRIBUTING](https://raw.githubusercontent.com/noxoua/filament-activity-log/main/.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
