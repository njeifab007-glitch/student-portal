<?php
require 'config.php';
if (!empty($_SESSION['student_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign in · Student Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;700;800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="shell">
    <section class="brand">
      <span class="logo">Student Portal</span>
      <div>
        <h1>Welcome back.<br>Your campus is one sign-in away.</h1>
        <p>Sign in to open your student dashboard and pick up where you left off.</p>
      </div>
    </section>

    <section class="panel">
      <h2 class="panel-title">Sign in</h2>

      <form id="loginForm" class="form" action="login.php" method="post">
        <label>Email
          <input type="email" name="email" autocomplete="email" required>
        </label>
        <label>Password
          <input type="password" name="password" autocomplete="current-password" required>
        </label>
        <button class="submit" type="submit">Sign in</button>
      </form>

      <p id="msg" class="msg" role="alert" aria-live="polite"></p>

      <p class="alt-link">New here? <a href="signup.php">Create an account</a></p>
    </section>
  </main>
  <script src="script.js"></script>
</body>
</html>
