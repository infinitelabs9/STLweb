<?php
session_start();
include __DIR__ . '/../database/db_conection.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    $key_code_input = trim(
        ($_POST['key_code_1'] ?? '') .
        ($_POST['key_code_2'] ?? '') .
        ($_POST['key_code_3'] ?? '') .
        ($_POST['key_code_4'] ?? '')
    );

    if (!$first_name || !$last_name || !$email || !$phone) {
        $error = "Please fill in all fields.";
    } elseif (strlen($key_code_input) != 4) {
        $error = "Please enter the complete 4-digit key code.";
    } elseif ($key_code_input !== '8787') {
        $error = "Invalid key code. Please ask the staff if you don't know the key code to proceed.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if (!$user) {
                $insertStmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, key_code) VALUES (:first_name, :last_name, :email, :phone, '8787')");
                $insertStmt->execute([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone' => $phone
                ]);
            }

            $_SESSION['user_email'] = $email;
            header("Location: set_password.php");
            exit();
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register | STLclub</title>
  <link rel="stylesheet" href="../css/regstyle.css?v=2">
</head>
<body>
  <div class="register-container">
    <div class="register-left">
      <h2>Join the <span class="maroon">STL</span><span class="red">club</span> Family</h2>
      <p>Be a part of our growing community. It only takes a minute to register.</p>
    </div>
    <div class="register-right">
      <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" action="register.php">
  <label for="first_name">First Name</label>
  <input type="text" id="first_name" name="first_name" placeholder="First Name" required value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" />

  <label for="last_name">Last Name</label>
  <input type="text" id="last_name" name="last_name" placeholder="Last Name" required value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" />

  <label for="email">Email</label>
  <input type="email" id="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />

  <label for="phone">Phone Number</label>
  <input type="text" id="phone" name="phone" placeholder="Phone Number" required value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" />

  <label for="key_code_1">4-Digit Key Code</label>
  <div class="key-code">
    <input type="text" id="key_code_1" name="key_code_1" maxlength="1" required />
    <input type="text" id="key_code_2" name="key_code_2" maxlength="1" required />
    <input type="text" id="key_code_3" name="key_code_3" maxlength="1" required />
    <input type="text" id="key_code_4" name="key_code_4" maxlength="1" required />
  </div>

  <button type="submit">Register</button>
</form>


      <p style="margin-top: 15px;">Already have an account?
        <a href="login.php">Login here</a>
      </p>
    </div>
  </div>
</body>
</html>
