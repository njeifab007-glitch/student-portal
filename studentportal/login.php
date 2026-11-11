<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request.');
}

$email    = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare('SELECT id, password_hash FROM students WHERE email = ?');
$stmt->execute([$email]);
$student = $stmt->fetch();

if (!$student || !password_verify($password, $student['password_hash'])) {
    respond(false, 'Email or password is incorrect.');
}

session_regenerate_id(true);
$_SESSION['student_id'] = (int) $student['id'];

respond(true, 'Signed in. Loading your dashboard.', ['redirect' => 'dashboard.php']);
