<?php
// Contact Form Configuration
return [
    'email' => [
        'to' => 'contacto@casinosgourmet.cl',
        'from' => 'noreply@casinosgourmet.cl',
        'subject' => 'Nueva cotización desde CasinosGourmet.cl'
    ],
    'security' => [
        'rate_limit_seconds' => 30, // Minimum seconds between submissions
        'enable_logging' => true,
        'log_file' => 'contact_log.txt'
    ],
    'validation' => [
        'max_message_length' => 2000,
        'max_name_length' => 100,
        'required_fields' => ['name', 'email', 'message']
    ]
];
?>
