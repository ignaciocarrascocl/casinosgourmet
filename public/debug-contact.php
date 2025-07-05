<?php
// Simple debug version to test basic functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';
$honeypot = $_POST['website'] ?? '';

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
    exit();
}

// Honeypot check
if (!empty($honeypot)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida']);
    exit();
}

// Simple email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit();
}

// Try to send email
$to = 'contacto@casinosgourmet.cl';
$subject = 'Test - Nueva cotización desde CasinosGourmet.cl';
$email_body = "Nombre: $name\nEmail: $email\nTeléfono: $phone\nMensaje: $message";
$headers = 'From: noreply@casinosgourmet.cl';

$mail_sent = mail($to, $subject, $email_body, $headers);

if ($mail_sent) {
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado exitosamente']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al enviar el mensaje']);
}
?>
