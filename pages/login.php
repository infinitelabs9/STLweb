<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../database/db_conection.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];

            $redirect = $_GET['redirect'] ?? 'user.php'; //go to user
            header("Location: " . $redirect); //to go back to postpage.php
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | STLclub</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Helvetica Neue', sans-serif;
      background-color: #f5f5f5;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      display: flex;
      width: 800px;
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .login-left {
      background-color: #f1f1f1;
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-left h2 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .login-left h2 span {
      color: #a30000;
    }

    .login-left p {
      font-size: 14px;
      color: #555;
      margin-top: 10px;
    }

    .login-right {
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-right form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .login-right input {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .login-right button[type="submit"] {
      background-color: #70c200;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .login-right button[type="submit"]:hover {
      background-color: #5da700;
    }

    .login-right button[type="button"] {
      background-color: #eaeaea;
      color: #333;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .login-right button[type="button"]:hover {
      background-color: #d5d5d5;
    }

    .error {
      color: red;
      margin-bottom: 10px;
    }
    .oauth-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 15px;
  font-size: 14px;
  cursor: pointer;
  border: none;
  border-radius: 6px;
  background-color: #f1f1f1;
  color: #333;
  transition: background-color 0.2s;
}

.oauth-btn:hover {
  background-color: #e0e0e0;
}

.oauth-btn .icon {
  width: 16px;
  height: 16px;
  object-fit: contain;
}

.oauth-btn.apple .icon {
  width: 30px;  /* slightly bigger */
  height: 25px;
}


  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-left">
      <h2>Welcome Back To <span>STLclub.</span></h2>
      <p>You can join the team which is better with you.</p>
    </div>
    <div class="login-right">
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" action="login.php<?= isset($_GET['redirect']) ? '?redirect=' . urlencode($_GET['redirect']) : '' ?>">
  <button type="button" class="oauth-btn">
  <img src="../pictures/logo/google.png" alt="Google" class="icon" />
    Continue with Google
</button>

<button type="button" class="oauth-btn apple">
  <img src="../pictures/logo/apple.png" alt="Apple" class="icon" />
  Continue with Apple
</button>



    <input type="email" name="email" placeholder="Type your email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
    <input type="password" name="password" placeholder="Type your password" required />

    <button type="submit" class="next-btn">Next</button>
  </form>

  <p style="margin-top: 15px; font-size: 14px; color: #555;">
    Don't have an account? 
    <a href="register.php" style="color: #70c200; text-decoration: none; font-weight: 600;">Register here</a>
  </p>
</div>

</body>
</html>