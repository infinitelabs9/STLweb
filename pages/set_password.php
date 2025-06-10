<?php
session_start();
include __DIR__ . '/../database/db_conection.php';

$error = "";
$success = "";

// Use session email or URL email param
$email = $_SESSION['user_email'] ?? ($_GET['email'] ?? '');

if (!$email) {
    die("No email specified. Please complete registration first.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (!$password || !$password_confirm) {
        $error = "Both password fields are required.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $password_confirm) {
        $error = "Passwords do not match.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE email = :email");
        $stmt->execute(['password_hash' => $password_hash, 'email' => $email]);

        if ($stmt->rowCount() > 0) {
            $success = "Password set successfully! Redirecting to login...";
            unset($_SESSION['user_email']); // optional cleanup
        } else {
            $error = "Email not found or password already set.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Set Password | STLclub</title>
<link rel="stylesheet" href="../css/set_password.css?v=2">
</head>
<body>

<?php if ($error): ?>
    <div class="message error"><?= htmlspecialchars($error) ?></div>
<?php elseif ($success): ?>
    <div class="message success"><?= htmlspecialchars($success) ?></div>
    <script>
        setTimeout(() => {
            window.location.href = 'login.php';
        }, 3000);
    </script>
<?php endif; ?>

<?php if (!$success): ?>
<form method="POST" action="set_password.php">
  <div class="header">
    <img src="../pictures/logo/stlclub.png" alt="STLclub Logo" />
 
    <p>We are better with you</p>
  </div>

  <label for="password">Password</label>
  <input id="password" name="password" type="password" required minlength="6" />

  <label for="password_confirm">Confirm Password</label>
  <input id="password_confirm" name="password_confirm" type="password" required minlength="6" />

  <label class="show-toggle" for="togglePassword">
    <input type="checkbox" id="togglePassword" />
    Show Passwords
  </label>

  <button type="submit">Set Password</button>
</form>
<?php endif; ?>

<script>
  document.getElementById('togglePassword').addEventListener('change', function() {
    const pw = document.getElementById('password');
    const pwc = document.getElementById('password_confirm');
    const type = this.checked ? 'text' : 'password';
    pw.type = pwc.type = type;
  });
</script>

</body>
</html>
