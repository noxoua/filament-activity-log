<?php

return [
    'title' => 'Activity history',

    'date_format' => 'Y-m-d',
    'time_format' => 'H:i:s',

    'filters' => [
        'causer' => 'Initiator',
        'subject_type' => 'Object',
        'subject_id' => 'Subject ID',
        'event' => 'Action',
    ],
    'table' => [
        'field' => 'Field',
        'old' => 'Old',
        'new' => 'New',
    ],
    'events' => [
        'updated' => [
            'title' => 'Updated',
            'description' => 'The record was updated at <u>:time</u>',
        ],
        'created' => [
            'title' => 'Created',
            'description' => 'The record was created at <u>:time</u>',
        ],
        'deleted' => [
            'title' => 'Deleted',
            'description' => 'Record was deleted at <u>:time</u>',
        ],
        'restored' => [
            'title' => 'Restored',
            'description' => 'Record was restored at <u>:time</u>',
        ],
        // Your custom events...
    ],
    'subjects' => [
        'user' => 'User',
        'client' => 'Client',
        'role' => 'Role',
        'product' => 'Product',
        'order' => 'Order',
        'category' => 'Category',
        'invoice' => 'Invoice',
        'payment' => 'Payment',
        'employee' => 'Employee',
        'shipment' => 'Shipment',
        // Your custom subjects...
    ],
    'attributes' => [
        'roles' => 'Roles',
        'category' => 'Category',
        'address' => 'Address',
        'title' => 'Title',
        'description' => 'Description',
        'text' => 'Text',
        'email' => 'E-mail',
        'excerpt' => 'Excerpt',
        'name' => 'Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'image' => 'Image',
        'photo' => 'Photo',
        'avatar' => 'Avatar',
        'number' => 'Number',
        'phone' => 'Phone',
        'price' => 'Price',
        'amount' => 'Amount',
        // Your custom attributes...
    ],
];
