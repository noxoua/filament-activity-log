---
title: Get Started
nav_order: 3
---

# Get Started

### Logger Class

The Logger class is a fundamental component of the "Filament Activity Log" package, responsible for capturing and logging activities related to specific models within your Laravel application. It offers powerful customization options to define precisely which events and data changes should be recorded, making it a flexible and versatile tool for tracking model-related actions.

### Key Features

- **Event Logging**: The Logger class can capture a variety of events related to your models, including record creation, updates, deletions, and restorations. These events are crucial for maintaining an audit trail of activities within your application.

- **Customization**: You can customize each Logger to track only the events and fields that are relevant to your application. This flexibility ensures that you log the data that matters most to your specific use case.

- **Types**: The Logger class supports various field/relation types, making it easy to log and display different types of data appropriately. This includes handling dates, times, media files, boolean values, and more.

- **Relation Support**: If your models have relationships with other models, Logger can track and log these related models as well. This is essential for understanding complex data dependencies.

- **Views**: Logger offers field value views, allowing you to specify how specific fields are displayed in the activity log views. You can use views like "avatar," "image," and "badge" to enhance the user experience.

- **Translated Keys**: For user-friendly activity logs, Logger allows you to map field keys to translated keys, ensuring that your logs are easily understandable in different languages.


### Create a Logger

Use the artisan command to create a logger.

```bash
php artisan make:filament-logger User
```

{: .note }
Once `UserLogger` is created, it immediately starts listening to model events.


### Sample

Here's a simple example of how to create a Logger for a User model:

```php
use App\Models\User;
use Noxo\FilamentActivityLog\Fields\Fields;
use Noxo\FilamentActivityLog\Fields\Field;
use Noxo\FilamentActivityLog\Loggers\Logger;

class UserLogger extends Logger
{
    // public static bool $disabled = true;

    public static ?string $model = User::class;

    public static ?array $events = [
        // 'created',
        // 'updated',
        'deleted',
        'restored',
    ];

    public static function fields(Fields $fields): Fields
    {
        return $fields->schema([
            'name',
            'email',
            'email_verified_at' => fn (Field $field) => $field->date()->badge(),
            'roles' => fn (Field $field) => $field->relation('name'),
            'media' => fn (Field $field) => $field->media(),
        ]);
    }
}
```
