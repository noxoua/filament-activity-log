<?php

return [
    'title' => 'Історія діяльності',

    'date_format' => 'j F, Y',
    'time_format' => 'H:i l',

    'filters' => [
        'date' => 'Дата',
        'causer' => 'Ініціатор',
        'subject_type' => 'Об\'єкт',
        'subject_id' => 'ID об\'єкту',
        'event' => 'Дія',
    ],
    'table' => [
        'field' => 'Поле',
        'old' => 'Старе',
        'new' => 'Нове',
        'no_records_yet' => 'Поки що немає записів',
    ],
    'events' => [
        'updated' => [
            'title' => 'Оновлено',
            'description' => 'Запис було оновлено в <u>:time</u>',
        ],
        'created' => [
            'title' => 'Створено',
            'description' => 'Запис було створено в <u>:time</u>',
        ],
        'deleted' => [
            'title' => 'Видалено',
            'description' => 'Запис було видалено в <u>:time</u>',
        ],
        'restored' => [
            'title' => 'Відновлено',
            'description' => 'Запис було відновлено в <u>:time</u>',
        ],
        // Your custom events...
    ],
    'subjects' => [
        'user' => 'Працівник',
        'client' => 'Клієнт',
        'role' => 'Роль',
        'product' => 'Товар',
        'order' => 'Замовлення',
        'category' => 'Категорія',
        'invoice' => 'Рахунок',
        'payment' => 'Платіж',
        'employee' => 'Співробітник',
        'shipment' => 'Відправлення',
        // Your custom subjects...
    ],
    'attributes' => [
        'roles' => 'Ролі',
        'category' => 'Категорія',
        'address' => 'Адреса',
        'title' => 'Назва',
        'description' => 'Опис',
        'text' => 'Текст',
        'email' => 'E-mail',
        'excerpt' => 'Уривок',
        'name' => 'Назва',
        'first_name' => 'Ім\'я',
        'last_name' => 'Прізвище',
        'image' => 'Зображення',
        'photo' => 'Фото',
        'avatar' => 'Аватар',
        'number' => 'Номер',
        'phone' => 'Телефон',
        'price' => 'Ціна',
        'amount' => 'Сума',
        // Your custom attributes...
    ],
    'boolean' => [
        'true' => 'Так',
        'false' => 'Ні',
    ],
];
