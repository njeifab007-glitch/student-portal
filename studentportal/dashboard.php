<?php
require 'config.php';

if (empty($_SESSION['student_id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT full_name, email, matricule, department, level, created_at FROM students WHERE id = ?');
$stmt->execute([$_SESSION['student_id']]);
$s = $stmt->fetch();

if (!$s) {
    header('Location: logout.php');
    exit;
}

function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

$parts    = preg_split('/\s+/', trim($s['full_name']));
$first    = $parts[0];
$initials = strtoupper(substr($parts[0], 0, 1) . (count($parts) > 1 ? substr(end($parts), 0, 1) : ''));
$joined   = date('j F Y', strtotime($s['created_at']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard · Student Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;700;800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="dash">
  <header class="topbar">
    <span class="logo">Student Portal</span>
    <a class="logout" href="logout.php">Sign out</a>
  </header>

  <main class="dash-main">
    <section class="welcome">
      <p class="greeting" id="greeting">Hello</p>
      <h1>Welcome, <?= e($first) ?>.</h1>
      <p class="sub">You joined on <?= e($joined) ?>. Your student card is below.</p>
    </section>

    <section class="idcard" aria-label="Student card">
      <div class="idcard-top">
        <div class="avatar"><?= e($initials) ?></div>
        <div>
          <h2><?= e($s['full_name']) ?></h2>
          <p><?= e($s['department']) ?></p>
        </div>
      </div>
      <dl class="idcard-grid">
        <div><dt>Matricule</dt><dd><?= e($s['matricule']) ?></dd></div>
        <div><dt>Level</dt><dd><?= e($s['level']) ?></dd></div>
        <div class="wide"><dt>Email</dt><dd><?= e($s['email']) ?></dd></div>
      </dl>
    </section>
  </main>

  <script>
    const h = new Date().getHours();
    document.getElementById('greeting').textContent =
      h < 12 ? 'Good morning' : h < 18 ? 'Good afternoon' : 'Good evening';
  </script>
</body>
</html>
