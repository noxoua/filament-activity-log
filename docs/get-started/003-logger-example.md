---
title: Logger Example
permalink: /get-started/logger-example
parent: Get Started
nav_order: 3.3
---

# Logger Example

___

Here's a simple example of a `Logger` for a `Product` model:

```php
use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Support\Htmlable;
use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\ResourceLogger\Field;
use Noxo\FilamentActivityLog\ResourceLogger\RelationManager;
use Noxo\FilamentActivityLog\ResourceLogger\ResourceLogger;
use Spatie\Activitylog\Models\Activity;

class ProductLogger extends Logger
{
    // public static bool $disabled = true;

    public static ?string $model = Product::class;

    public static function getLabel(): string | Htmlable | null
    {
        // return __('Product');
        return ProductResource::getModelLabel();
    }

    public function getSubjectRoute(Activity $activity): ?string
    {
        return ProductResource::getUrl('edit', ['record' => $activity->subject_id]);
    }

    public function getRelationManagerRoute(Activity $activity): ?string
    {
        return $this->getSubjectRoute($activity).'?activeRelationManager=0';
    }

    public static function resource(ResourceLogger $logger): ResourceLogger
    {
        return $logger
            // Resource Fields
            ->fields([
                Field::make('title')
                    ->label(__('Title')),

                Field::make('categories.name')
                    ->label(__('Categories'))
                    ->hasMany('categories')
                    ->badge(),

                Field::make('media')
                    ->label(__('Images'))
                    ->media(gallery: true),

                Field::make('price')
                    ->label(__('Price'))
                    ->money('EUR'),

                Field::make('status')
                    ->label(__('Status'))
                    ->enum(ProductStatus::class),

                Field::make('active')
                    ->label(__('Visible'))
                    ->boolean(),
            ])
            // Relation Managers
            ->relationManagers([
                RelationManager::make('accessories')
                    ->label('Accessory')
                    ->fields([
                        Field::make('name')
                            ->label(__('Label')),

                        Field::make('price')
                            ->label(__('Price'))
                            ->money('EUR'),
                    ]),
            ]);
    }
}
```

