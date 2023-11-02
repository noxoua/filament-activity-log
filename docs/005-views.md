---
title: Views
nav_order: 7
---

# Views

Within the Logger class, you have the ability to customize how specific fields are displayed in the activity log views by using the `views` property.

Here's an example of how you can define the `views` property to control the display of certain fields:

```php
public static ?array $views = [
    'email_verified_at' => 'badge',
    'media' => 'avatar',
    'roles' => 'badge',
];
```

In this example, we've assigned different views to specific fields. Let's explore the available views:

- `avatar`: Displays the field as an avatar in the activity log view.
- `image`: Similar to "avatar," but may have a different border-radius.
- `badge`: Renders the field as a badge, often used for representing statuses or labels.
- `associative_array`: Visualizes the field as an associative array in the activity log view.

---

Customizing views using the views property enables you to present specific fields in a way that best communicates their purpose and significance within the context of your activity log views. This level of control ensures a meaningful and informative representation of the logged data.
