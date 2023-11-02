---
title: Types
nav_order: 6
---

# Types

The Logger class provides the `types` property, which allows you to specify how fields and relations should be logged in terms of their data types and formatting.

Here's how you can define the `types` property to customize logging for specific fields and relations:

```php
public static ?array $types = [
    'email_verified_at' => 'datetime:Y-m-d', // Format is optional
    'media' => 'media', // Spatie media-library
    'roles' => 'pluck:name', // Relation
];
```

In the example above, we've set up different types for the fields and relations that need to be logged. Let's take a closer look at the available types:

____

The `types` property in the Logger class allows you to specify how fields and relations should be logged, taking into account their data types and formatting. It provides a way to customize how these values are presented in the activity log. Let's dive into the different available types and their descriptions:

| Type                | Description                                      | Example Usage                        |
|---------------------|--------------------------------------------------|--------------------------------------|
| Date                | Logs as a date.                                   | `'date'`                            |
| Time                | Logs as a time.                                   | `'time'`                            |
| Date and Time       | Logs as a date and time.                          | `'datetime'`                        |
| Media               | Logs as media (Spatie media-library).             | `'media'`                           |
| Multiple Media      | Logs multiple media entries.                      | `'media:multiple'`                  |
| Boolean             | Logs as a boolean value (true or false).          | `'boolean'`                         |
| Specific Attributes | Logs specific attributes.                         | `'only:first_name,last_name'`       |
| Single Attribute    | Logs a specific related attribute.                | `'pluck:first_name'`                |
| Enum                | Logs enums with custom labels, colors, and icons. [Filament enum](https://filamentphp.com/docs/3.x/support/enums) | `'enum:' . CustomEnum::class` |
| Monetary Value      | Logs as a monetary value with specified currency. | `'money:USD'`                       |


_____

By using the `types` property, you can fine-tune how your fields and relations are recorded in the activity log, making the log entries more informative and aligned with your application's data types and requirements. This level of customization ensures that your activity logs are clear, relevant, and easy to interpret.
