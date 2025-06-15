<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard | STLclub</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f5f5f5;
    }

    header {
      background-color: #70c200;
      padding: 20px;
      color: white;
      text-align: center;
    }

    .container {
      padding: 40px;
      max-width: 800px;
      margin: 0 auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-top: 40px;
    }

    h2 {
      margin-bottom: 10px;
    }

    .info {
      margin-top: 20px;
    }

    .logout-btn {
      background: #a30000;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
    }

    .logout-btn:hover {
      background: #820000;
    }
  </style>
</head>
<body>

<header>
  <h1>Welcome, <?= htmlspecialchars($_SESSION['first_name']) ?>!</h1>
</header>

<div class="container">
  <h2>Your Information</h2>
  <div class="info">
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
    <p><strong>User ID:</strong> <?= htmlspecialchars($_SESSION['user_id']) ?></p>
  </div>

  <a href="../index.php" class="logout-btn">Go Home</a>
  <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
</html>
