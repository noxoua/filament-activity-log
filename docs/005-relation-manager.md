---
title: Relation Manager
permalink: /relation-manager
nav_order: 5
---

# Relation Manager

___

In Filament, you can create special "relation managers" for handling related data in your resource. Imagine you have a resource with a relation called `accessories`. Here's a straightforward example of defining such a relation manager:

```php
$logger->relationManagers([
    'accessories' => fn (RelationManager $relationManager) => $relationManager
        ->label('Accessory')
        ->fields([
            'name' => fn (Field $field) => $field
                ->label(__('Label')),

            'price' => fn (Field $field) => $field
                ->label(__('Price'))
                ->money('EUR'),
        ]),
]);
```

By creating relation managers, you can organize and format related data the way you want in your Filament application.