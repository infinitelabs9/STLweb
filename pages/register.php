<?php
include 'db_conection.php';  //  DB connection

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    // Combine the 4 key code inputs into one string
    $key_code = trim(($_POST['key_code_1'] ?? '') . ($_POST['key_code_2'] ?? '') . ($_POST['key_code_3'] ?? '') . ($_POST['key_code_4'] ?? ''));

    // Simple validation 
    if (!$first_name || !$last_name || !$email || !$phone || strlen($key_code) != 4) {
        $error = "Please fill all fields and complete the key code.";
    } else {
        try {
            // Prepare SQL insert
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, key_code) VALUES (:first_name, :last_name, :email, :phone, :key_code)");
            $stmt->execute([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'key_code' => $key_code
            ]);

            $success = "Registration successful!";

            // Send key code via email
            $to = $email;
            $subject = "Your Key Code for STLclub";
            $message = "Hello $first_name,\n\nThank you for registering with STLclub.\nYour key code is: $key_code\n\nBest regards,\nSTLclub Team";
            $headers = "From: no-reply@stlclub.com\r\n" .
                       "Reply-To: no-reply@stlclub.com\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            mail($to, $subject, $message, $headers);

        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | STLclub</title>
  <link rel="stylesheet" href="../css/regstyle.css" />
</head>
<body>

<div class="container">
  <div class="left">
    <h2>Get Started with <span class="stl">STL</span><span class="club">club.</span></h2>
    <p>You can join the team which fits better with you.</p>
  </div>

  <div class="divider"></div>

  <div class="right">

    <?php if ($error): ?>
      <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
      <p style="color:green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post" action="register.php">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required>
      </div>

      <div class="form-group key-code-group">
        <label for="key_code">Key Code</label>
        <div class="key-code-inputs">
          <input type="text" maxlength="1" class="key-digit" name="key_code_1" value="<?= htmlspecialchars($_POST['key_code_1'] ?? '') ?>" required>
          <input type="text" maxlength="1" class="key-digit" name="key_code_2" value="<?= htmlspecialchars($_POST['key_code_2'] ?? '') ?>" required>
          <input type="text" maxlength="1" class="key-digit" name="key_code_3" value="<?= htmlspecialchars($_POST['key_code_3'] ?? '') ?>" required>
          <input type="text" maxlength="1" class="key-digit" name="key_code_4" value="<?= htmlspecialchars($_POST['key_code_4'] ?? '') ?>" required>
        </div>
      </div>

      <button type="submit">Next</button>
    </form>
  </div>
</div>

</body>
</html>
