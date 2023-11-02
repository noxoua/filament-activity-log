---
title: Fields & Relations
nav_order: 5
---

# Fields & Relations

In the context of the Logger class, you have the flexibility to define which fields and relations should be logged for your model. This allows you to track changes to specific attributes and related data.


### Fields

You can specify the fields that need to be logged using the `fields` property. Here's an example of how you can define the fields to be logged:

```php
public static ?array $fields = [
    'name',
    'email',
    'email_verified_at',
];
```

By configuring this property, you can ensure that changes to the specified fields are recorded in the activity log.


### Relations

Similarly, you can specify the relations that should be logged using the `relations` property. This allows you to track changes to related data within your model. Here's an example of how you can define the relations to be logged:

```php
public static ?array $relations = [
    'roles',
    'media',
];
```

By configuring this property, you can monitor and log any modifications made to the specified relations.

___

By customizing the `fields` and `relations` properties according to your application's needs, you can have granular control over which data changes are tracked and recorded in the activity log.
