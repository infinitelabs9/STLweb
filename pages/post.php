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

   .latest-stories {
  padding: 60px;
  max-width: 1200px;
  margin: auto;
}

.latest-stories h2 {
  font-size: 32px;
  margin-bottom: 40px;
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

.facebook-icon i {
  color: #ffffff;
  /* Facebook */
  font-size: 33px;
}

.instagram-icon i {
  color: #ffffff;
  /* Instagram */
  font-size: 33px;
}

.threads-icon i {
  color: rgb(252, 252, 252);
  /* Threads */
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
            <a href="/index.php" class="caja">Home</a>
            <a href="/pages/post.php" class="caja">Post</a>
            <a href="/pages/apply.php" class="caja">Apply</a>
            <a href="/pages/about.php" class="caja">About Us</a>
            <a href="/pages/login.php" class="caja">Login</a>
        </div>
        </div>
    </div>

     <section class="latest-stories">
    <h2>Latest Stories</h2>

    <div class="story">
      <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_4.jpg" alt="Rocket Team" />
      <div class="story-text">
        <h3>How We Built Our Hybrid Rocket for the 2024 Competition.</h3>
        <p>You can join in the team which is better with you.</p>
      </div>
    </div>

    <div class="story">
      <img src="../pictures/imagenes/IMG_0944.jpeg" alt="Rocket Team" />
      <div class="story-text">
        <h3>How We Built Our Hybrid Rocket for the 2024 Competition.</h3>
        <p>You can join in the team which is better with you.</p>
      </div>
    </div>

    <div class="story">
      <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_10.jpg" alt="Rocket Team" />
      <div class="story-text">
        <h3>How We Built Our Hybrid Rocket for the 2024 Competition.</h3>
        <p>You can join in the team which is better with you.</p>
      </div>
    </div>

    <div class="story">
      <img src="../pictures/imagenes/LINE_ALBUM_2024.08.05 Polaris發射_250512_5.jpg" alt="Rocket Team" />
      <div class="story-text">
        <h3>How We Built Our Hybrid Rocket for the 2024 Competition.</h3>
        <p>You can join in the team which is better with you.</p>
      </div>
    </div>

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
        <a href="post.php"><h2 class="foot-div">Post</h2></a>
        <a href="apply.php"><h2 class="foot-div">Apply</h2></a>
        <a href="about.php"><h2 class="foot-div">About Us</h2></a>
      </div>
    </div>

</body>
</html>