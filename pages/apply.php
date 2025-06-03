<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Diseño Responsivo</title>
<link rel="stylesheet" href="../css/apply.css" />
<link rel="stylesheet" href="apply.css?v=2">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

  <div class="conte-body">

    <div class="conte-header">
    <div class="subcon1-0">
  STL<span class="highlight">club</span>
</div>
      <div class="menu">
        <a href="home.php"><div class="caja">Home</div></a>
        <a href="post.php"><div class="caja">Post</div></a>
        <a href="apply.php"><div class="caja">Apply</div></a>
        <a href="about.php"><div class="caja">About Us</div></a>
        <a href="login.php"><div class="caja">Login</div></a>


<a href=""></a>


      </div>
    </div>
 <div class="step-container">
  <h2 class="step-title">Applications Forms</h2>

  <!-- Barra de progreso -->
  <div class="step-progressbar">
    <div class="step-wrapper">
      <div class="step active">1</div>
      <div class="step-label">Step 1</div>
    </div>
    <div class="step-wrapper">
      <div class="step">2</div>
      <div class="step-label">Step 2</div>
    </div>
    <div class="step-wrapper">
      <div class="step">3</div>
      <div class="step-label">Step 3</div>
    </div>
  </div>

  <!-- Contenido por pasos -->
  <form id="formSteps">
    <div class="step-form step-form-active">
      <h3>Basic Information</h3>
      <label>Full Name</label>
      <input type="text" placeholder="Full Name..." required>

      <label>Student ID</label>
      <input type="text" placeholder="Type your id number..." required>

      <label>Email</label>
      <input type="email" placeholder="Type your gmail..." required>

      <label>Department</label>
      <input type="text" placeholder="Type your Department..." required>
      
<label>CV</label>
   <div class="file-input-container"> 
  <label class="file-input-label" for="cv">Select CV file</label>
  <input
    type="file"
    id="cv"
    name="cv"
    accept=".pdf, .doc, .docx, image/*"
    required
  >
</div>

      <label for="team">List Team</label>
<div class="select-wrapper">
  <select id="team" name="team" required>
    <option value="">Select</option>
    <option value="engineering">Engineering</option>
    <option value="design">Design</option>
    <option value="marketing">Marketing</option>
  </select>
</div>

    </div>

    <div class="step-form">
      <h3>Additional Info</h3>
      <label>Why do you want to join?</label>
      <textarea placeholder="Typing..." required></textarea>
    </div>

    <div class="step-form">
      <h3>Confirm</h3>
      <p>Review your information before submitting.</p>
      <!-- Aquí puedes mostrar un resumen si quieres -->
    </div>

    <div class="buttons">
      <button type="button" id="prevBtn" style="display: none;">Back</button>
      <button type="button" id="nextBtn">Next</button>
    </div>
  </form>
</div>

    <div class="footer-con">  
  <h1 class="foot-sub1">
    STL<span class="highlight2">club</span>
  </h1>

 <div class="foot-sub2">

  <div class="sub-foot">
 <a href="https://facebook.com/tuperfil" target="_blank" class="foot-div2 facebook-icon">
  <i class="fab fa-facebook-f"></i>
</a>

<a href="https://instagram.com/tuperfil" target="_blank" class="foot-div2 instagram-icon">
  <i class="fab fa-instagram"></i>
</a>

<a href="https://threads.net/tuperfil" target="_blank" class="foot-div2 threads-icon">
  <i class="fa-brands fa-threads"></i>
</a>


  </div>
</div>


  <div class="foot-sub3">
    <a href="post.php"><h2 class="foot-div">Post</h2> </a>
    <a href="apply.php"><h2 class="foot-div">Apply</h2> </a>
    <a href="about.php"><h2 class="foot-div">About Us</h2> </a>
  </div>
</div>


</div>

  

</div>

<div class="foot-sub"></div>



  </div>
  <script src="../js/apply.js"></script>

</body>
</html>
