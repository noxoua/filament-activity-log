---
title: Create Activity Page
permalink: /get-started/create-activity-page
parent: Get Started
nav_order: 3.1
---

# Create Activity Page

____

Create a page in your pages folder `app/Filament/Pages/` and extends the `ListActivities` class.

```php
<?php

namespace App\Filament\Pages;

use Noxo\FilamentActivityLog\Pages\ListActivities;

class Activities extends ListActivities
{
    // public function getTitle(): string
    // {
    //     return __('filament-activity-log::activities.title');
    // }

    // public static function getNavigationLabel(): string
    // {
    //     return __('filament-activity-log::activities.title');
    // }

}
```

By extending the `ListActivities` class, you are creating a new activity page that is ready to display the activity logs for your Filament application.
