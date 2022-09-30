<?php

use app\models\ActiveRecord\Users\UserType;

return [
    [
        'id' => UserType::ADMIN_USER_ID,
        'name' => 'Администратор',
        'slug' => UserType::ADMIN_USER_TYPE,
    ],
    [
        'id' => UserType::STANDART_USER_ID,
        'name' => 'Стандартный пользователь',       
        'slug' => UserType::STANDART_USER_TYPE,
    ],
    
];

