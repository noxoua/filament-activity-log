---
title: Link Causer/Subject
nav_order: 11
---

# Link Causer/Subject

In Filament Activity Log, you have the ability to link the "causer" and "subject" of an activity log entry. The "causer" is typically the user who performed an action, while the "subject" is the item or entity that was acted upon. To create links to these "causer" and "subject" pages, you can use the following code as a reference:

```php
use App\Filament\Pages\Activities;

// UserResource
$table->actions([
    // User actions
    Action::make('activities')
        ->url(fn ($record) => Activities::getCauserUrl($record))
])

// ProductResource
$table->actions([
    // History of changes
    Action::make('activities')
        ->url(fn ($record) => Activities::getSubjectUrl($record))
])
```

The code provides links to the "causer" and "subject" pages based on the context. In the "UserResource" example, it generates links to view the activities of a user. In the "ProductResource" example, it links to view the history of changes related to a product.

___

By using this approach, you can easily navigate between users, products, or any other entities and access their corresponding activity logs.
