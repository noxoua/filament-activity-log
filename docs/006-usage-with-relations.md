---
title: Usage with Relations
nav_order: 8
---

# Usage with Relations

If you want to log relations as well, you should comment out the `created` and `updated` events and add `relations` that you want to log.

```php
public static ?array $events = [
    // 'created',
    // 'updated',
    'deleted',
    'restored',
];

public static ?array $relations = ['roles', 'media'];
```

## Resource with pages

When your Filament resource uses separate pages for creating and editing records, you can enable activity logging with the following methods:

### CreateRecord

To enable activity logging when creating records in Filament, you should use the `LogCreateRecord` trait in your `CreateRecord` class as follows:

```php
use Noxo\FilamentActivityLog\Concerns\Resource\LogCreateRecord;

class CreateUser extends CreateRecord
{
    use LogCreateRecord; // Add this trait to your CreateRecord class

    protected static string $resource = UserResource::class;
}
```

{: .highlight }
Already have `afterCreate` method?

If you have custom logic within the `afterCreate` method, ensure to include the call to `logAfterCreate` at the end of your method. This will generate the activity log entry after the creation process is complete.


```php
public function afterCreate()
{
    // Your code to create the record...

    // Log the creation event with the activity logger
    $this->logAfterCreate();
}
```

---

### EditRecord

To enable activity logging when editing records in Filament, you should use the `LogEditRecord` trait in your `EditRecord` class:

```php
use Noxo\FilamentActivityLog\Concerns\Resource\LogEditRecord;

class EditUser extends EditRecord
{
    use LogEditRecord; // Add this trait to your EditRecord class

    protected static string $resource = UserResource::class;
}
```

{: .highlight }
Already have `beforeValidate` or `afterSave` method?

If you have custom logic within the `beforeValidate` method and/or `afterSave` method, make sure to call `logBeforeValidate` at the beginning of the `beforeValidate` method and `logAfterSave` at the end of the `afterSave` method. This ensures that the changes to the record, including any changes in the specified relations, are logged correctly.

```php
public function beforeValidate()
{
    // Log the changes before validate
    $this->logBeforeValidate();

    // Your custom code for tasks before validate...
}

public function afterSave()
{
    // Your custom code after the record is saved...

    // Log the changes after saving
    $this->logAfterSave();
}
```

_____

## Resource with modals

When your Filament resource uses modals for creating and editing records, you can configure the logger for the `CreateAction` and `EditAction` as follows:

### CreateAction

To set the logger for the `CreateAction` on the resource's list page, you can use the `setLogger` method within the `getHeaderActions` method. Here's an example:

```php
class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Filament\Actions\CreateAction::make()
                ->setLogger(App\Filament\Loggers\UserLogger::class),
        ];
    }
}
```
In this code, the `CreateAction` is configured to use the `UserLogger` to log activity when creating records.

### EditAction

To set the logger for the `EditAction` within the resource table's actions, you can use the `setLogger` method as shown in the example below:

```php
->actions([
    Tables\Actions\EditAction::make()
        ->setLogger(App\Filament\Loggers\UserLogger::class),
]),
```

This configuration ensures that the `EditAction` logs activity using the `UserLogger` when editing records within your Filament resource.

___

By specifying the logger for these actions, you can seamlessly integrate activity logging into your resource when using modals for creating and editing records.
