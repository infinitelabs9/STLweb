<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../database/db_conection.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../index.php"); 
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>STLclub Login</title>
  <link rel="stylesheet" href="../css/login-style.css" />

</head>
<body>
  <div class="container">
    <div class="left">
      <h2>Welcome Back To <br /><span class="stl">STL</span><span class="club">club.</span></h2>
      <p>You can join the team which is better with you.</p>
    </div>

    <div class="divider"></div>

    <div class="right">
      <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
      <form method="post" action="login.php">
        <div class="social-login">
          <button type="button" class="google-btn">Continue with Google</button>
          <button type="button" class="apple-btn">Continue with Apple</button>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" placeholder="Type your email" required />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" placeholder="Type your password" required />
        </div>
        <button type="submit">Next</button>
      </form>
    </div>
  </div>
</body>
</html>
