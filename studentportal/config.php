<?php
// Database settings (XAMPP defaults: user "root", empty password)
const DB_HOST = 'localhost';
const DB_NAME = 'student_portal';
const DB_USER = 'root';
const DB_PASS = '';

session_start();

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Could not connect to the database. Is MySQL running in XAMPP, and did you import database.sql?');
}

function respond(bool $ok, string $message, array $extra = []): void {
    header('Content-Type: application/json');
    echo json_encode(array_merge(['ok' => $ok, 'message' => $message], $extra));
    exit;
}
