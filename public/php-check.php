<?php
// PHP Configuration Checker for Contact Form
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$requirements = [
    'php_version' => [
        'current' => PHP_VERSION,
        'minimum' => '7.4.0',
        'status' => version_compare(PHP_VERSION, '7.4.0', '>=')
    ],
    'modules' => [
        'filter' => extension_loaded('filter'),
        'session' => extension_loaded('session'),
        'json' => extension_loaded('json'),
        'mbstring' => extension_loaded('mbstring'),
        'openssl' => extension_loaded('openssl'),
        'mail' => function_exists('mail'),
        'curl' => extension_loaded('curl'),
        'gd' => extension_loaded('gd')
    ],
    'functions' => [
        'mail' => function_exists('mail'),
        'filter_var' => function_exists('filter_var'),
        'json_encode' => function_exists('json_encode'),
        'session_start' => function_exists('session_start'),
        'file_put_contents' => function_exists('file_put_contents')
    ],
    'settings' => [
        'file_uploads' => ini_get('file_uploads'),
        'post_max_size' => ini_get('post_max_size'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'max_execution_time' => ini_get('max_execution_time'),
        'memory_limit' => ini_get('memory_limit'),
        'allow_url_fopen' => ini_get('allow_url_fopen'),
        'session.auto_start' => ini_get('session.auto_start')
    ],
    'server_info' => [
        'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
        'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown',
        'php_sapi' => php_sapi_name(),
        'os' => PHP_OS,
        'timezone' => date_default_timezone_get()
    ]
];

// Check critical requirements
$critical_missing = [];
if (!$requirements['php_version']['status']) {
    $critical_missing[] = 'PHP version too old: ' . PHP_VERSION . ' (need 7.4+)';
}

foreach (['filter', 'session', 'json'] as $module) {
    if (!$requirements['modules'][$module]) {
        $critical_missing[] = "Missing critical module: $module";
    }
}

if (!$requirements['functions']['mail']) {
    $critical_missing[] = 'mail() function not available';
}

$requirements['status'] = [
    'ready_for_contact_form' => empty($critical_missing),
    'critical_issues' => $critical_missing,
    'warnings' => []
];

// Add warnings for optional but recommended features
if (!$requirements['modules']['mbstring']) {
    $requirements['status']['warnings'][] = 'mbstring extension recommended for better string handling';
}

if (!$requirements['modules']['openssl']) {
    $requirements['status']['warnings'][] = 'openssl extension recommended for security';
}

if (!$requirements['modules']['curl']) {
    $requirements['status']['warnings'][] = 'curl extension recommended for external requests';
}

echo json_encode($requirements, JSON_PRETTY_PRINT);
?>
