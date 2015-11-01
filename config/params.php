<?php

return [
    'adminEmail' => 'admin@plrs.com',
    'email' => [
        'subject' => 'Account Create Successful',
        'body' => 'Dear {name},<br/>'
        . 'Your account has been created with username: <strong>{name}</strong>, passcode: <strong>{passcode}</strong>.<br/>'
        . 'You use your account to view your medical report.'
    ]
];
