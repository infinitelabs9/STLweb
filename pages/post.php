<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // Adjust based on your login system

// Connect to the database
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'stl_database';

$conn = new mysqli('localhost', 'root', '', 'stl_database');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$posts = [];
$sql = "SELECT title, message, image FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Posts</title>
  <style>
    
    body {
      margin: 0;
      font-family: sans-serif;
    }

    .conte-body {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .conte-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 20px 50px;
      box-sizing: border-box;
    }

    .subcon1-0 {
      font-size: 50px;
      font-weight: bold;
      padding-left: 60px;
    }

    .menu {
      display: flex;
      gap: 38px;
    }

    .caja {
      font-size: 23px;
      background: none;
      border: none;
      color: #555;
      cursor: pointer;
      transition: color 0.3s ease;
      text-decoration: none;
    }

    .caja:hover {
      color: #612D2D;
    }

    .latest-stories {
      padding: 60px;
      max-width: 1200px;
      margin: auto;
    }

    .latest-stories h2 {
      font-size: 32px;
      margin-bottom: 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .story {
      display: flex;
      align-items: center;
      background-color: #f9f9f9;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      margin-bottom: 35px;
      padding: 24px;
    }

    .story img {
      width: 360px;
      height: 240px;
      border-radius: 12px;
      object-fit: cover;
      margin-right: 30px;
    }

    .story-text h3 {
      font-size: 24px;
      font-weight: bold;
      margin: 0 0 16px 0;
    }

    .story-text p {
      margin: 0;
      font-size: 18px;
      color: #555;
    }

    .create-button {
      padding: 10px 20px;
      background-color: #6ea653;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
    }

    .footer-con {
      display: flex;
      margin-top: 30px;
      background-color: #612D2D;
      width: 100%;
      max-width: 1850px;
      height: 300px;
      align-items: center;
      justify-content: space-between;
    }

    .foot-sub1 {
      margin-left: 50px;
    }

    .foot-div2 {
      margin-top: 80px;
      margin-left: 50px;
      color: #888888;
    }

    .sub-foot {
      margin-right: 17px;
    }

    .facebook-icon i,
    .instagram-icon i,
    .threads-icon i {
      color: #ffffff;
      font-size: 33px;
    }

    .foot-sub3 {
      margin-top: 2px;
      flex-direction: column;
      align-items: end;
      margin-right: 14px;
    }

    .foot-div {
      margin-top: 25px;
      margin-left: 50px;
      color: #ffffff;
    }

    @media (max-width: 768px) {
      .about-content {
        flex-direction: column;
        padding: 20px;
      }

      .story {
        flex-direction: column;
        text-align: center;
      }

      .story img {
        margin: 0 0 20px 0;
        width: 100%;
        height: auto;
      }

      .story-text {
        text-align: left;
      }

      .latest-stories h2 {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="conte-body">
    <div class="conte-header">
      <div class="subcon1-0">
        STL<span style="color: #612D2D">club</span>
      </div>
      <div class="menu">
        <a href="home.php" class="caja">Home</a>
        <a href="post.php" class="caja">Post</a>
        <a href="apply.php" class="caja">Apply</a>
        <a href="about.php" class="caja">About Us</a>
        <a href="login.php" class="caja">Login</a>
      </div>
    </div>
  </div>

  <section class="latest-stories">
    <h2>
      <span>Latest Stories</span>
      <a href="<?= $isLoggedIn ? 'postpage.php' : 'login.php' ?>" class="create-button">Create a Post</a>
    </h2>

    <?php if (!empty($posts)): ?>
      <?php foreach ($posts as $post): ?>
        <div class="story">
          <?php if (!empty($post['image'])): ?>
            <img src="uploads/<?= htmlspecialchars($post['image']) ?>" alt="Post Image" />
          <?php endif; ?>
          <div class="story-text">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($post['message'])) ?></p>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No posts yet. Be the first to share your story!</p>
    <?php endif; ?>
  </section>

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
      <a href="postpage.php"><h2 class="foot-div">Post</h2></a>
      <a href="apply.php"><h2 class="foot-div">Apply</h2></a>
      <a href="about.php"><h2 class="foot-div">About Us</h2></a>
    </div>
  </div>
</body>
</html>
