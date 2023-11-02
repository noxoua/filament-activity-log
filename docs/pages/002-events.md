---
title: Events
nav_order: 4
---

# Events

The Logger class provides an automatic event logging mechanism through the `$events` property, which captures common events like "created," "updated," "deleted," and "restored." Additionally, it allows you to manually trigger these events from anywhere in your code. Here's a brief explanation of how to use these manual event logging methods:

### Automatic Event Logging:

The `$events` property specifies the events that will be automatically logged by the Logger class without the need for manual intervention. The class will capture these events and create corresponding logs when they occur.


### Manual Event Logging:

In addition to automatic event logging, you have the flexibility to manually trigger these events using the Logger class. Here's how to use the manual event logging methods:


- `UserLogger::make($record)->created();`: Manually logs a "created" event for the given $record. This can be used to log the creation of a new record.

- `UserLogger::make($old_record, $new_record)->updated();`: Manually logs an "updated" event, capturing changes between the $old_record (before the update) and the $new_record (after the update). This allows you to log updates to a record.

- `UserLogger::make($record)->deleted();`: Manually logs a "deleted" event for the given $record, indicating that the record has been deleted.

- `UserLogger::make($record)->restored();`: Manually logs a "restored" event, typically used when a previously deleted record is restored.

By providing these manual event logging methods, the Logger class offers fine-grained control over when and how specific events are logged, allowing you to capture custom events and changes in your application as needed.


### Add a Custom Event

You have the flexibility to add custom events to your `UserLogger` class to log specific actions or activities in your application. In this example, we've added a custom event called `transaction_deposit`, which is triggered when a deposit transaction is made.

Here's how you can implement a custom event in your `UserLogger` class:


1. Define the custom event method within your `UserLogger` class. In this case, we've created the `transaction_deposit` method.

```php
class UserLogger extends ActivityLogger
{
    // ...

    public function transaction_deposit($transaction): void
    {
        // Define the attributes you want to log for the event
        $attributes = [
            'amount' => $transaction->amount,
            'additional_info' => $transaction->meta['text'] ?? null,
        ];

        // Log the event with the specified attributes and event name
        $this->log(
            ['old' => [], 'attributes' => $attributes],
            event: 'deposit',
        );
    }
}
```

2. To trigger the custom event, you can use the `->transaction_deposit` method. This method will log the event with the provided attributes, such as the deposit amount and any additional information:

```php
// Trigger the custom event
UserLogger::make($user_record)->transaction_deposit($transaction);
```

By following this approach, you can easily extend the functionality of your logger to capture custom events and their associated attributes, enabling you to track specific activities within your application.
