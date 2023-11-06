---
title: Hooks
permalink: /hooks
nav_order: 7
---

# Hooks

____

## Resolve State

In certain scenarios, you might want to log custom fields or complex relations within your models in a structured manner. Filament Activity Log provides the `resolveStateUsing` method for this purpose. It allows you to define custom logic to resolve the state of a field before it's logged. Here's how you can use it:

```php
return $logger
    ->preloadRelations('items.product')
    ->fields([
        Field::make('items')
            ->hasMany('items')
            ->table(differenceOnly: true)
            ->resolveStateUsing(static function (Model $record) {
               return $record->items->map(fn ($item) => [
                  'Product' => $item->product->name,
                  'Quantity' => $item->qty,
                  'Unit Price' => $item->unit_price,
               ])->toArray();
            })
            ->label('Items'),
   ])
```

{: .note }
Keep in mind that it is not recommended to load relations inside `resolveStateUsing` because logging may not work correctly. Instead, use the `preloadRelations` function to preload all the necessary relationships.


In the provided example, we're defining a field named 'items.' We use the `resolveStateUsing` method to specify a custom resolution logic. Inside the closure, we access the related 'items' for the record and map them to an array of structured data. This structured data will be logged for the 'items' field.

## Format State

The `formatStateUsing` method allows you to customize the format of a field's state before it's displayed. This can be helpful when you want to format the state in a specific way. Here's how you can use it:

```php
return $logger->fields([
    Field::make('status')
        ->formatStateUsing(fn (string $state): string => __("statuses.{$state}")),
]);
```

In this example, we're defining a field named 'status,' and we use the `formatStateUsing` method to format the state value. The provided closure takes the state value as input and uses it to retrieve the corresponding translation using Laravel's localization feature. This ensures that the 'status' field is logged with a user-friendly and localized value.

