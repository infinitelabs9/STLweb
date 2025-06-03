<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About us</title>
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

    .about-content {
      display: flex;
      gap: 40px;
      padding: 80px;
      align-items: center;
    }

    .text-column {
      flex: 1;
      min-width: 300px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-self: flex-start;
      height: 600px;
      padding-left: 80px;
    }

    .text-column h1 {
      font-size: 46px;
      margin-bottom: 30px;
      align-self: flex-start;
    }

    .text-column p {
      font-size: 30px;
      line-height: 1.6;
    }

    .image-column {
      display: flex;
      gap: 20px;
      flex: 1;
      height: 660px;
      padding-right: 70px;
    }

    .tall-img {
      width: 350px;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
    }

    .stacked-small {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .stacked-small img {
      width: 300px;
      height: calc(50% - 10px);
      object-fit: cover;
      border-radius: 8px;
    }

    .org-section {
      width: 100%;
      padding: 40px 120px;
      box-sizing: border-box;
    }

    .org-title {
      font-size: 50px;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }

    .org-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
    }

    .org-card {
      display: flex;
      background: white;
      padding: 10px;
      border-radius: 10px;
      align-items: center;
      gap: 20px;
    }

    .org-card img {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }

    .org-text h3 {
      margin: 0 0 5px;
      font-size: 25px;
    }

    .org-text p {
      font-size: 20px;
      color: #555;
    }

    .footer {
    padding: 30px 50px;
    color: black;
    padding: 0;
  }

  .footer-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding-left: 30px;
    padding-right: 30px;
  }

  .footer-logo {
    font-size: 24px;
    font-weight: bold;
  }

  .footer-logo span {
    color: #612D2D;
    font-weight: bold;
  }

  .footer-social {
    text-align: center;
    flex: 1;
  }

  .footer-social span {
    font-size: 18px;
    font-weight: 500;
  }

  .footer-social a {
    margin: 0 8px;
    text-decoration: none;
    font-size: 18px;
    color: black;
  }

  .footer-bottom {
    text-align: center;
    margin-top: 10px;
    background-color: black;
    padding: 0;
  }

  .footer-bottom p {
    color: #aaa;
    font-size: 12px;
    margin: 0;
  }


    @media (max-width: 768px) {
      .about-content {
        flex-direction: column;
        padding: 20px;
      }

      .image-column,
      .text-column {
        height: auto;
        padding: 0;
      }

      .tall-img,
      .stacked-small img {
        width: 100%;
        height: auto;
      }

      .org-card {
        flex: 0 1 100%;
      }
      .org-grid {
        grid-template-columns: 1fr;
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

    <div class="about-content">
      <div class="text-column">
        <h1>What is STL Aero Space?</h1>
        <p>
          Tamkang University's Rocketry Club, as we design, build, and launch high-powered rockets that push the limits of student innovation. From local projects to international competitions, we're a team of dreamers, engineers, and explorers committed to shaping the future of aerospace.
        </p>
      </div>

      <div class="image-column">
        <img src="../pictures/imagenes/IMG_0945.jpeg" class="tall-img">
        <div class="stacked-small">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_4.jpg">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_5.jpg">
        </div>
      </div>
    </div>

     <div class="org-section">
      <div class="org-title">Organization Team</div>
      <div class="org-grid">
        <div class="org-card">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_2.jpg" alt="System">
          <div class="org-text">
            <h3>System Design</h3>
            <p>Handles rocket architecture, aerodynamics, and simulations.</p>
          </div>
        </div>
        <div class="org-card">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_2.jpg" alt="Avionics">
          <div class="org-text">
            <h3>Avionics</h3>
            <p>Focuses on onboard electronics, telemetry, and data logging.</p>
          </div>
        </div>
        <div class="org-card">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_7.jpg" alt="Propulsion">
          <div class="org-text">
            <h3>Propulsion</h3>
            <p>Develops propulsion systems for launch vehicles.</p>
          </div>
        </div>
        <div class="org-card">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_9.jpg" alt="Recovery">
          <div class="org-text">
            <h3>Recovery</h3>
            <p>Designs parachutes and safe descent mechanisms.</p>
          </div>
        </div>
        <div class="org-card">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_4.jpg" alt="Structure">
          <div class="org-text">
            <h3>Structure</h3>
            <p>Ensures structural integrity under high-stress conditions.</p>
          </div>
        </div>
        <div class="org-card">
          <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_8.jpg" alt="Parachute">
          <div class="org-text">
            <h3>Parachute</h3>
            <p>Manages deployment of multi-stage parachutes for recovery.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-top">
      <div class="footer-logo">
        STL<span style="color: #612D2D">club</span>
      </div>
      <div class="footer-social">
        <span>Follow us</span><br>
        <a href="#">insta</a>
        <a href="#">facebook</a>
      </div>
      
    </div>
    <div class="footer-bottom">
      <p>© 2025 STLclub. All rights reserved</p>
    </div>
  </footer>


</body>
</html>
