---
title: Resource with pages
permalink: /get-started/resource-with-pages
parent: Get Started
nav_order: 3.4
---

# Resource with pages

___

When your Filament resource uses separate pages for creating and editing records, you need to enable activity logging with the following methods:

## CreateRecord

To enable activity logging when creating records in Filament, you should use the `LogCreateRecord` trait in your `CreateRecord` class as follows:

```php
use Noxo\FilamentActivityLog\Extensions\LogCreateRecord;

class CreateProduct extends CreateRecord
{
    use LogCreateRecord; // <--- here

    protected static string $resource = ProductResource::class;
}
```

{: .highlight }
Already have `afterCreate` method?

If you have custom logic within the `afterCreate` method, ensure to include the call to `logAfterCreate` at the end of your method. This will generate the activity log entry after the creation process is complete.


```php
public function afterCreate()
{
    // your code...

    $this->logRecordCreated($this->record);
}
```

---

## EditRecord

To enable activity logging when editing records in Filament, you should use the `LogEditRecord` trait in your `EditRecord` class:

```php
use Noxo\FilamentActivityLog\Extensions\LogEditRecord;

class EditProduct extends EditRecord
{
    use LogEditRecord; // <--- here

    protected static string $resource = ProductResource::class;
}
```

{: .highlight }
Already have `beforeValidate` or `afterSave` method?

If you have custom logic within the `beforeValidate` method and/or `afterSave` method, make sure to call `logBeforeValidate` at the beginning of the `beforeValidate` method and `logAfterSave` at the end of the `afterSave` method. This ensures that the changes to the record, including any changes in the specified relations, are logged correctly.

```php
public function beforeValidate()
{
    $this->logRecordBefore($this->record);

    // your code...
}

public function afterSave()
{
    // your code...

   $this->logRecordAfter($this->record);
}
```
