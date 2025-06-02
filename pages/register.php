<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';  // Adjust if needed
include __DIR__ . '/../database/db_conection.php';  // Adjust if needed

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

    if (isset($_POST['send_code'])) {
        if (!$first_name || !$last_name || !$email || !$phone) {
            $error = "Please fill in all fields before sending the key code.";
        } else {
            try {
                // Check if user exists
                $stmt = $pdo->prepare("SELECT key_code FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch();

                if (!$user) {
                    // Generate code and insert new user
                    $generated_key_code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
                    $insertStmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, key_code) VALUES (:first_name, :last_name, :email, :phone, :key_code)");
                    $insertStmt->execute([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'phone' => $phone,
                        'key_code' => $generated_key_code
                    ]);
                } else {
                    $generated_key_code = $user['key_code'];
                }

                // Send email
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'localhost';
                $mail->Port = 1025;
                $mail->SMTPAuth = false;

                $mail->setFrom('no-reply@stlclub.local', 'STLclub');
                $mail->addAddress($email, $first_name);

                $mail->isHTML(false);
                $mail->Subject = 'Your Key Code for STLclub';
                $mail->Body = "Hello $first_name,\n\nThank you for registering with STLclub.\nYour key code is: $generated_key_code\n\nPlease enter this code in the form below to proceed.\n\nBest regards,\nSTLclub Team";

                $mail->send();

                $success = "We sent you a 4-digit key code by email. Please check your inbox and enter it below.";
            } catch (Exception $e) {
                $error = "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
            } catch (PDOException $e) {
                $error = "Database error: " . $e->getMessage();
            }
        }
    } elseif (isset($_POST['verify_code'])) {
        if (!$first_name || !$last_name || !$email || !$phone) {
            $error = "Please fill in all fields.";
        } elseif (strlen($key_code_input) != 4) {
            $error = "Please enter the complete 4-digit key code.";
        } else {
            try {
                $stmt = $pdo->prepare("SELECT key_code FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch();

                if (!$user) {
                    $error = "No registration found for this email. Please send the key code first.";
                } else {
                    if ($user['key_code'] === $key_code_input) {
                        $_SESSION['user_email'] = $email;
                        header("Location: set_password.php");
                        exit();
                    } else {
                        $error = "Invalid key code. Please check your email and try again.";
                    }
                }
            } catch (PDOException $e) {
                $error = "Database error: " . $e->getMessage();
            }
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
  <style>
    .send-code-btn {
      padding: 4px 8px;
      font-size: 0.5em;
      cursor: pointer;
      height: 2.5em;
    }
    .phone-group {
      display: flex;
      align-items: center;
    }
    .key-code-group > div {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .key-code-group input[type="text"] {
      width: 2em;
      text-align: center;
      font-size: 1.2em;
    }
  </style>
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
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required />
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
      </div>

      <div class="form-group phone-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required />
      </div>

      <!-- Key Code Inputs with Send Code button -->
      <div class="form-group key-code-group" style="margin-top: 20px;">
        <label for="key_code">Enter Key Code</label>
        <div>
          <input type="text" maxlength="1" name="key_code_1" value="<?= htmlspecialchars($_POST['key_code_1'] ?? '') ?>" required />
          <input type="text" maxlength="1" name="key_code_2" value="<?= htmlspecialchars($_POST['key_code_2'] ?? '') ?>" required />
          <input type="text" maxlength="1" name="key_code_3" value="<?= htmlspecialchars($_POST['key_code_3'] ?? '') ?>" required />
          <input type="text" maxlength="1" name="key_code_4" value="<?= htmlspecialchars($_POST['key_code_4'] ?? '') ?>" required />

          <button type="submit" name="send_code" class="send-code-btn">Send Code</button>
        </div>
      </div>

      <button type="submit" name="verify_code" style="margin-top: 10px;">Next</button>
    </form>
  </div>
</div>

<script>
  const inputs = document.querySelectorAll('input[name^="key_code_"]');
  inputs.forEach((input, i) => {
    input.addEventListener('input', () => {
      if (input.value.length === 1 && i < inputs.length - 1) {
        inputs[i + 1].focus();
      }
    });
  });
</script>

</body>
</html>
