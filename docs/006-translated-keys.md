---
title: Translated Keys
nav_order: 8
---

# Translated Keys

The Logger class provides the `attributeMap` property, which allows you to map field keys to make translations user-friendly. This is particularly useful when you want to present field names in a more readable or user-friendly manner.
Here's how you can use the attributeMap property:

```php
public static ?array $attributeMap = [
    'name' => 'first_name',
    'media' => 'avatar',
];
```

In this example, the `attributeMap` property is defined to map the field keys 'name' to 'first_name' and 'media' to 'avatar'. This mapping allows you to present these fields with more descriptive and user-friendly names in the activity log views or any other related components.

For instance, instead of displaying `name` in the logs, the attribute will be shown as `first_name`, providing a clearer understanding of the logged information. You can configure these mappings based on your application's specific needs, making the logs more accessible and meaningful for users.
