<?php
// Production ready contact handler
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Check if script is being executed
if (!defined('PHP_VERSION')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'PHP not available']);
    exit();
}

// Start output buffering to catch any unwanted output
ob_start();

// Basic access check
if (!isset($_SERVER['REQUEST_METHOD'])) {
    ob_clean();
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied - no request method']);
    exit();
}

try {
    // Load configuration with error handling
    $config_file = __DIR__ . '/config.php';
    if (!file_exists($config_file)) {
        $config_file = dirname(__FILE__) . '/config.php';
        if (!file_exists($config_file)) {
            throw new Exception('Configuration file not found');
        }
    }
    $config = require_once $config_file;

    // Validate config structure
    if (!is_array($config) || !isset($config['email'])) {
        throw new Exception('Invalid configuration structure');
    }

    // Set headers
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    // Handle preflight requests
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }
} catch (Exception $e) {
    // Clear any previous output
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error de configuración del servidor: ' . $e->getMessage()]);
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

// Security: Rate limiting (basic implementation)
try {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $current_time = time();
    $last_submission = $_SESSION['last_submission'] ?? 0;
    $min_interval = $config['security']['rate_limit_seconds'];

    // Also check IP-based rate limiting (prevent same IP spam)
    $user_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $ip_key = 'ip_' . md5($user_ip);
    $last_ip_submission = $_SESSION[$ip_key] ?? 0;

    if ($current_time - $last_submission < $min_interval || 
        $current_time - $last_ip_submission < $min_interval) {
        ob_clean();
        http_response_code(429);
        echo json_encode(['success' => false, 'message' => 'Por favor espera antes de enviar otro mensaje']);
        exit();
    }
} catch (Exception $e) {
    // Continue without session if there's an issue
    $current_time = time();
    $last_submission = 0;
}

// Input validation and sanitization
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get and validate form data
$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');
$honeypot = $_POST['website'] ?? ''; // Honeypot field

// Honeypot check (anti-spam)
if (!empty($honeypot)) {
    ob_clean();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida']);
    exit();
}

// Validate required fields
$errors = [];

if (empty($name) || strlen($name) > $config['validation']['max_name_length']) {
    $errors[] = 'El nombre es requerido y debe tener menos de ' . $config['validation']['max_name_length'] . ' caracteres';
}

if (empty($email)) {
    $errors[] = 'El email es requerido';
} elseif (!validateEmail($email)) {
    $errors[] = 'Email inválido';
}

if (empty($message) || strlen($message) > $config['validation']['max_message_length']) {
    $errors[] = 'El mensaje es requerido y debe tener menos de ' . $config['validation']['max_message_length'] . ' caracteres';
}

// Check for suspicious content
$suspicious_patterns = [
    '/\b(viagra|cialis|casino|poker|loan|credit|debt)\b/i',
    '/\b(click here|visit now|act now|urgent|limited time)\b/i',
    '/<script/i',
    '/<iframe/i',
    '/javascript:/i'
];

foreach ($suspicious_patterns as $pattern) {
    if (preg_match($pattern, $message) || preg_match($pattern, $name)) {
        $errors[] = 'Contenido no permitido detectado';
        break;
    }
}

if (!empty($errors)) {
    ob_clean();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit();
}

// Email configuration
$to = $config['email']['to'];
$subject = $config['email']['subject'];
$headers = [
    'From: ' . $config['email']['from'],
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/html; charset=UTF-8'
];

// Email body
$email_body = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #BD5B57; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #BD5B57; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>Nueva Cotización - Casinos Gourmet</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='label'>Nombre:</div>
                <div>" . htmlspecialchars($name) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Email:</div>
                <div>" . htmlspecialchars($email) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Teléfono:</div>
                <div>" . htmlspecialchars($phone ?: 'No proporcionado') . "</div>
            </div>
            <div class='field'>
                <div class='label'>Mensaje:</div>
                <div>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Fecha:</div>
                <div>" . date('d/m/Y H:i:s') . "</div>
            </div>
            <div class='field'>
                <div class='label'>IP:</div>
                <div>" . $_SERVER['REMOTE_ADDR'] . "</div>
            </div>
        </div>
    </div>
</body>
</html>
";

// Send email
try {
    $mail_sent = mail($to, $subject, $email_body, implode("\r\n", $headers));

    if ($mail_sent) {
        // Update session to prevent spam
        try {
            if (isset($_SESSION)) {
                $_SESSION['last_submission'] = $current_time;
                $_SESSION[$ip_key] = $current_time; // Track IP submission time
            }
        } catch (Exception $e) {
            // Continue if session update fails
        }
        
        // Log successful submission (optional)
        if ($config['security']['enable_logging']) {
            try {
                $log_entry = date('Y-m-d H:i:s') . " - Email sent from: $email ($name)\n";
                file_put_contents($config['security']['log_file'], $log_entry, FILE_APPEND | LOCK_EX);
            } catch (Exception $e) {
                // Continue if logging fails
            }
        }
        
        // Clear any buffered output and send success response
        ob_clean();
        echo json_encode(['success' => true, 'message' => 'Mensaje enviado exitosamente']);
    } else {
        ob_clean();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al enviar el mensaje. Intenta nuevamente.']);
    }
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error del servidor. Intenta nuevamente.']);
}
?>
