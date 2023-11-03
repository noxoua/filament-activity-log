---
title: Fields
nav_order: 4
---

# Fields

In the context of the Logger class, you have the flexibility to define which fields and relations should be logged for your model. This allows you to track changes to specific attributes and related data.


### Badge

```php
$fields->schema([
   'name' => 'badge:danger',
   // 'name' => fn (Field $field) => $field->badge('danger'),
])
```

![Screenshot](./assets/images/badge-screenshot.png)

____

### Enum

```php
$fields->schema([
   'status' => fn (Field $field) => $field
         ->enum(App\Enums\OrderStatus::class)
         ->label('Status'),
])
```

![Screenshot](./assets/images/enum-screenshot.png)

____

### Date & Time

```php
$fields->schema([
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
$fields->schema([
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
$fields->schema([
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
$fields->schema([
   // 'price' => 'money:EUR',
   'price' => fn (Field $field) => $field->money('EUR'),
])
```

![Screenshot](./assets/images/money-screenshot.png)

____

### Key-Value

```php
$fields->schema([
   'meta' => fn (Field $field) => $field
         ->view('key-value')
         ->label('Attributes'),
])
```

![Screenshot](./assets/images/key-value-screenshot.png)

____

### Relation

```php
$fields->schema([
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
$fields->schema([
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
