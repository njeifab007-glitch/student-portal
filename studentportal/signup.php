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
  <title>Create account · Student Portal</title>
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
        <h1>Register once.<br>Your campus is one sign-in away.</h1>
        <p>Create your account, then land straight on your student dashboard.</p>
      </div>
    </section>

    <section class="panel">
      <h2 class="panel-title">Create account</h2>

      <form id="registerForm" class="form" action="register.php" method="post">
        <label>Full name
          <input type="text" name="full_name" autocomplete="name" required>
        </label>
        <label>Email
          <input type="email" name="email" autocomplete="email" required>
        </label>
        <div class="row">
          <label>Matricule
            <input type="text" name="matricule" required>
          </label>
          <label>Level
            <select name="level" required>
              <option value="" disabled selected>Pick one</option>
              <option>Level 100</option>
              <option>Level 200</option>
              <option>Level 300</option>
              <option>Level 400</option>
            </select>
          </label>
        </div>
        <label>Department
          <input type="text" name="department" placeholder="e.g. Software Engineering" required>
        </label>
        <label>Password
          <input type="password" name="password" minlength="6" autocomplete="new-password" required>
        </label>
        <button class="submit" type="submit">Create account</button>
      </form>

      <p id="msg" class="msg" role="alert" aria-live="polite"></p>

      <p class="alt-link">Already have an account? <a href="index.php">Sign in</a></p>
    </section>
  </main>
  <script src="script.js"></script>
</body>
</html>
