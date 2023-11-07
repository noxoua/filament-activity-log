---
title: Relation Manager
permalink: /relation-manager
nav_order: 6
---

# Relation Manager

___

{: .note }
Keep in mind `RelationManager` has nothing to do with regular relations in your resource. Learn more about [Filament Relation Managers](https://filamentphp.com/docs/3.x/panels/getting-started#introducing-relation-managers){:target="_blank"}.


___


Imagine you have a resource with a relation called `accessories`. Here's a straightforward example of defining such a relation manager:

```php
$logger->relationManagers([
    RelationManager::make('accessories')
        ->label('Accessory')
        ->fields([
            Field::make('name'),
            Field::make('price'),
        ]),
]);
```
