<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request.');
}

$name       = trim($_POST['full_name'] ?? '');
$email      = strtolower(trim($_POST['email'] ?? ''));
$matricule  = strtoupper(trim($_POST['matricule'] ?? ''));
$department = trim($_POST['department'] ?? '');
$level      = trim($_POST['level'] ?? '');
$password   = $_POST['password'] ?? '';

if ($name === '' || $email === '' || $matricule === '' || $department === '' || $level === '' || $password === '') {
    respond(false, 'Fill in every field to register.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'Enter a valid email address.');
}
if (strlen($password) < 6) {
    respond(false, 'Your password needs at least 6 characters.');
}

$check = $pdo->prepare('SELECT id FROM students WHERE email = ? OR matricule = ?');
$check->execute([$email, $matricule]);
if ($check->fetch()) {
    respond(false, 'That email or matricule is already registered. Try signing in.');
}

$insert = $pdo->prepare(
    'INSERT INTO students (full_name, email, matricule, department, level, password_hash)
     VALUES (?, ?, ?, ?, ?, ?)'
);
$insert->execute([$name, $email, $matricule, $department, $level, password_hash($password, PASSWORD_DEFAULT)]);

session_regenerate_id(true);
$_SESSION['student_id'] = (int) $pdo->lastInsertId();

respond(true, 'Account created. Taking you to your dashboard.', ['redirect' => 'dashboard.php']);
