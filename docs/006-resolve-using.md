---
title: Resolve Using
nav_order: 6
---

# Resolve Using

There may be cases in which you have custom fields or complex relations within your models that you wish to log in a structured manner. To achieve this, you can use the `resolveUsing` method.


```php
public static function fields(Fields $fields): Fields
{
    return $fields->schema([

        'roles' => fn (Field $field) => $field
            ->relation()
            ->resolveUsing(static function (Model $model): array {
                return $model->roles
                    ->filter(fn($role) => $role->name !== 'super_secret_admin')
                    ->toArray();
            }),

    ]);
}
```

