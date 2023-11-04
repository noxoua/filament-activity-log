---
title: Resolve Using
permalink: /resolve-using
nav_order: 6
---

# Resolve Using

___

There may be cases in which you have custom fields or complex relations within your models that you wish to log in a structured manner. To achieve this, you can use the `resolveUsing` method.


```php
return $logger->fields([

    'roles' => fn (Field $field) => $field
        ->relation()
        ->resolveUsing(static function (Model $model): array {
            return $model->roles
                ->filter(fn($role) => $role->name !== 'super_secret_admin')
                ->toArray();
        }),
        // ->resolveUsing(function ($model) {
        //     return $model->items->map(fn ($item) => [
        //         'Product' => Product::find($item->shop_product_id)->name,
        //         'Quantity' => $item->qty,
        //         'Unit Price' => $item->unit_price,
        //     ])->toArray();
        // })

]);
```

