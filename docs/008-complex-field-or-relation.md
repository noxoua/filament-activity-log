---
title: Complex Field/Relation
nav_order: 10
---

# Complex Field/Relation

There may be cases in which you have custom fields or complex relations within your models that you wish to log in a structured manner. To achieve this, you can define a method in your logger. As an example, consider the `processMeta` method shown below:


```php
class UserLogger extends ActivityLogger
{
    // ...

    public function processMeta(Model $model): mixed
    {
        $attributes = [];

        // Iterate through the 'meta' attribute of the model
        foreach ($model->meta as $value) {
            // Define the custom attributes you want to log
            $attributes[$value['custom_name']] = $value['custom_value'];
        }

        // Return the processed attributes
        return $attributes;
    }
}
```

The method iterates through the `meta` attribute, extracting specific custom attributes, and storing them in the `$attributes` array. These processed attributes can then be logged as part of an activity event.

The naming convention used here, with `process` as the prefix and `Meta` as the field name in `ucfirst` format, helps maintain clarity and consistency when handling custom fields or complex relations within your models.

