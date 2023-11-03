---
title: Get Started
nav_order: 3
---

# Get Started

### Logger Class

The Logger class is a fundamental component of the "Filament Activity Log" package, responsible for capturing and logging activities related to specific models within your Laravel application. It offers powerful customization options to define precisely which events and data changes should be recorded, making it a flexible and versatile tool for tracking model-related actions.

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
use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Support\Htmlable;
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

    public static function getLabel(): string|Htmlable|null
    {
        // return __('User');
        return UserResource::getModelLabel();
    }

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
