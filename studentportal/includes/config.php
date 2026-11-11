<?php
session_start();

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'student_portal';

function connect_db()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $conn->set_charset('utf8mb4');

    return $conn;
}

function redirect_with_message($page, $type, $message)
{
    $message = urlencode($message);
    header("Location: {$page}?{$type}={$message}");
    exit();
}
?>
