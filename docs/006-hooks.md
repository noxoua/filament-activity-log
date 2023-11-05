---
title: Hooks
permalink: /hooks
nav_order: 6
---

# Hooks

____

## Resolve Using

In certain scenarios, you might want to log custom fields or complex relations within your models in a structured manner. Filament Activity Log provides the `resolveStateUsing` method for this purpose. It allows you to define custom logic to resolve the state of a field before it's logged. Here's how you can use it:

```php
return $logger->fields([
    Field::make('items')
        ->resolveStateUsing(function (Model $record) {
            return $record->items->map(fn ($item) => [
                'Product' => Product::find($item->shop_product_id)->name,
                'Quantity' => $item->qty,
                'Unit Price' => $item->unit_price,
            ])->toArray();
        }),
]);
```

In the provided example, we're defining a field named 'items.' We use the `resolveStateUsing` method to specify a custom resolution logic. Inside the closure, we access the related 'items' for the record and map them to an array of structured data. This structured data will be logged for the 'items' field.

## Format Using

The `formatStateUsing` method allows you to customize the format of a field's state before it's displayed. This can be helpful when you want to format the state in a specific way. Here's how you can use it:

```php
return $logger->fields([
    Field::make('status')
        ->formatStateUsing(fn (string $state): string => __("statuses.{$state}")),
]);
```

In this example, we're defining a field named 'status,' and we use the `formatStateUsing` method to format the state value. The provided closure takes the state value as input and uses it to retrieve the corresponding translation using Laravel's localization feature. This ensures that the 'status' field is logged with a user-friendly and localized value.

