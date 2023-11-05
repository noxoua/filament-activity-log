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
   // Field::make('name')->badge('danger'),
])
```

![Screenshot](./assets/images/badge-screenshot.png)

____

### Enum

```php
$logger->fields([
   Field::make('status')
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
   Field::make('published_at')
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
   Field::make('is_visible')
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
   Field::make('media')
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
   Field::make('price')->money('EUR'),
])
```

![Screenshot](./assets/images/money-screenshot.png)

____

### Key-Value

```php
$logger->fields([
   Field::make('meta')
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
   Field::make('categories')
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
   Field::make('items')
         ->relation()
         ->table(differenceOnly: true)
         ->resolveStateUsing(static function (Model $record) {
            return $record->items->map(fn ($item) => [
               'Product' => Product::find($item->shop_product_id)->name,
               'Quantity' => $item->qty,
               'Unit Price' => $item->unit_price,
            ])->toArray();
         })
         ->label('Items'),
])
```

![Screenshot](./assets/images/table-screenshot.png)
