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
<title>Set Password</title>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 40px;
        background: #f4f4f4;
    }
    form {
        background: white;
        padding: 30px;
        max-width: 400px;
        margin: auto;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
        margin-top: 15px;
        font-weight: bold;
        display: block;
    }
    input {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
    .show-toggle {
        margin-top: 10px;
        display: flex;
        align-items: center;
        font-size: 14px;
    }
    .show-toggle label {
        margin: 0 0 0 8px;
    }
    button {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background-color: #6ca933;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
    }
    .message {
        text-align: center;
        margin-bottom: 20px;
    }
    .error { color: red; }
    .success { color: green; }
</style>
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
    <label for="password">Password</label>
    <input id="password" name="password" type="password" required minlength="6" />

    <label for="password_confirm">Confirm Password</label>
    <input id="password_confirm" name="password_confirm" type="password" required minlength="6" />

    <div class="show-toggle">
      <input type="checkbox" id="togglePassword" />
      <label for="togglePassword">Show Passwords</label>
    </div>

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
