---
title: Fields
nav_order: 4
---

# Fields

In the context of the Logger class, you have the flexibility to define which fields and relations should be logged for your model. This allows you to track changes to specific attributes and related data.


### Badge

```php
 $fields->schema([
    // 'created_at' => 'badge:danger',
    'created_at' => fn (Field $field) => $field->badge('info'),
 ])
```


### Date & Time

```php
 $fields->schema([
    // 'created_at' => 'date',
    // 'created_at' => 'time',
    // 'created_at' => 'datetime',
    'created_at' => fn (Field $field) => $field
        ->date('j F, Y')
        ->badge(),
 ])
```


### Boolean

```php
 $fields->schema([
    // 'is_active' => 'boolean',
    'is_active' => fn (Field $field) => $field->boolean(),
 ])
```


### Media

```php
 $fields->schema([
    // 'media' => 'media',
    'media' => fn (Field $field) => $field
        ->media(gallery: true) // for multiple images
        // ->circle()
        ->square(),
 ])
```


### Money

```php
 $fields->schema([
    // 'total' => 'money:EUR',
    'total' => fn (Field $field) => $field->money('USD'),
 ])
```


### Associative Array

```php
 $fields->schema([
    'json' => fn (Field $field) => $field->view('associative_array'),
 ])
```


### Relation

```php
 $fields->schema([
    'roles' => fn (Field $field) => $field
        // get only role names
        ->relation('name'),
 ])
```

### Translated Key

```php
 $fields->schema([
    // 'media' => 'translatedKey:profile_photo',
    'media' => fn (Field $field) => $field->translatedKey('profile_photo'),
 ])
```


