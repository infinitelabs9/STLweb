<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../database/db_conection.php';

// Fetch user's attendance data
$stmt = $pdo->prepare("SELECT * FROM attendance WHERE user_id = :uid ORDER BY date DESC");
$stmt->execute(['uid' => $_SESSION['user_id']]);
$attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Dashboard - STLclub</title>
  <link rel="stylesheet" href="../css/user-style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      padding: 30px;
    }
    h1, h2 {
      color: #333;
    }
    .logout {
      float: right;
      padding: 8px 12px;
      background-color: crimson;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #eee;
    }
  </style>
</head>
<body>

  <a href="logout.php" class="logout">Logout</a>

  <h1>Welcome, <?= htmlspecialchars($_SESSION['email']) ?>!</h1>
  <h2>Your Attendance</h2>

  <?php if (count($attendance) > 0): ?>
    <table>
      <tr>
        <th>Date</th>
        <th>Status</th>
      </tr>
      <?php foreach ($attendance as $record): ?>
        <tr>
          <td><?= htmlspecialchars($record['date']) ?></td>
          <td><?= htmlspecialchars($record['status']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>You have no attendance records yet.</p>
  <?php endif; ?>

</body>
</html>
