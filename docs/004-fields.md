---
title: Fields
permalink: /fields
nav_order: 4
has_children: true
---

# Fields

___

In the context of the Logger class, you have the flexibility to define which fields and relations should be logged for your model. This allows you to track changes to specific attributes and related data.


### Badge

```php
$logger->fields([
   'name' => 'badge:danger',
   // 'name' => fn (Field $field) => $field->badge('danger'),
])
```

![Screenshot](./assets/images/badge-screenshot.png)

____

### Enum

```php
$logger->fields([
   'status' => fn (Field $field) => $field
         ->enum(App\Enums\OrderStatus::class)
         ->label('Status'),
])
```

![Screenshot](./assets/images/enum-screenshot.png)

____

### Date & Time

```php
$logger->fields([
   // 'published_at' => 'date:j F, Y'',
   // 'published_at' => 'time',
   // 'published_at' => 'datetime',
   'published_at' => fn (Field $field) => $field
         ->date()
         ->label('Publish Date'),
])
```

![Screenshot](./assets/images/datetime-screenshot.png)

____

### Boolean

```php
$logger->fields([
   // 'is_visible' => 'boolean',
   'is_visible' => fn (Field $field) => $field
         ->boolean()
         ->label('Visible'),
])
```

![Screenshot](./assets/images/boolean-screenshot.png)

____

### Media

```php
$logger->fields([
   // 'media' => 'media',
   'media' => fn (Field $field) => $field
         ->media(gallery: true)
         ->label('Images'),
])
```

![Screenshot](./assets/images/media-screenshot.png)

____

### Money

```php
$logger->fields([
   // 'price' => 'money:EUR',
   'price' => fn (Field $field) => $field->money('EUR'),
])
```

![Screenshot](./assets/images/money-screenshot.png)

____

### Key-Value

```php
$logger->fields([
   'meta' => fn (Field $field) => $field
         ->view('key-value')
         ->label('Attributes'),
])
```

![Screenshot](./assets/images/key-value-screenshot.png)

____

### Relation

```php
$logger->fields([
   // 'categories' => 'relation:name',
   'categories' => fn (Field $field) => $field
         ->relation('name') // get names only
         ->badge('info')
         ->label('Categories'),
])
```

![Screenshot](./assets/images/relation-screenshot.png)

____

### Table

```php
$logger->fields([
   'items' => fn (Field $field) => $field
         ->relation()
         ->table()
         ->resolveUsing(function ($model) {
            return $model->items->map(fn ($item) => [
               'Product' => Product::find($item->shop_product_id)->name,
               'Quantity' => $item->qty,
               'Unit Price' => $item->unit_price,
            ])->toArray();
         })
         ->label('Items'),
])
```

![Screenshot](./assets/images/table-screenshot.png)
