<?php
session_start();

if (isset($_POST['submit'])) {
    $conn = new mysqli('localhost', 'root', '', 'stl_database');
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $name = trim($_POST['name']);
    $student_id = trim(string: $_POST['student_id']);
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);

    $image_name = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $tmp_name = $_FILES['image']['tmp_name'];
        $original_name = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed_ext)) {
            $image_name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $original_name);
            move_uploaded_file($tmp_name, $uploadDir . $image_name);
        } else {
            echo "<p style='color: red; text-align:center;'>Formato de imagen no permitido.</p>";
            $image_name = null;
        }
    }

    $sql = "INSERT INTO posts (name, student_id, title, message, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $student_id, $title, $message, $image_name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p style='color: green; text-align: center;'>¡Post send!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error al enviar el post.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Post</title>
  <link rel="stylesheet" href="../css/apply.css" />
  <link rel="stylesheet" href="apply.css?v=2" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <div class="conte-body">
    <div class="conte-header">
      <div class="subcon1-0">STL<span class="highlight">club</span></div>
      <div class="menu">
        <a href="../index.php"><div class="caja">Home</div></a>
        <a href="post.php"><div class="caja">Post</div></a>
        <a href="apply.php"><div class="caja">Apply</div></a>
        <a href="about.php"><div class="caja">About Us</div></a>
        <a href="login.php"><div class="caja">Login</div></a>
      </div>
    </div>

    <div class="step-container">
      <h2 class="step-title">Create a Post</h2>

      <form method="POST" enctype="multipart/form-data" action="postpage.php">
        <div class="step-form step-form-active" style="gap:20px;">
          <label>Name</label>
          <input type="text" name="name" placeholder="Your name..." required />

          <label>Student ID</label>
          <input type="text" name="student_id" placeholder="Your student ID..." required />

          <label>Title</label>
          <input type="text" name="title" placeholder="Post title..." required />

          <label>Message</label>
          <textarea name="message" placeholder="Write your message..." rows="5" required></textarea>

          <label>Image (optional)</label>
          <div class="file-input-container" style="width: 80%;">
            <label class="file-input-label" for="image">Select image file</label>
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif" />
          </div>

          <div class="buttons" style="justify-content: flex-end;">
            <button type="submit" name="submit">Submit Post</button>
          </div>
        </div>
      </form>
    </div>

    <div class="footer-con">
      <h1 class="foot-sub1">STL<span class="highlight2">club</span></h1>
      <div class="foot-sub2">
        <div class="sub-foot">
          <a href="https://facebook.com/tuperfil" target="_blank" class="foot-div2 facebook-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="https://instagram.com/tuperfil" target="_blank" class="foot-div2 instagram-icon"><i class="fab fa-instagram"></i></a>
          <a href="https://threads.net/tuperfil" target="_blank" class="foot-div2 threads-icon"><i class="fa-brands fa-threads"></i></a>
        </div>
      </div>
      <div class="foot-sub3">
        <a href="post.php"><h2 class="foot-div">Post</h2></a>
        <a href="apply.php"><h2 class="foot-div">Apply</h2></a>
        <a href="about.php"><h2 class="foot-div">About Us</h2></a>
      </div>
    </div>
  </div>
</body>
</html>
