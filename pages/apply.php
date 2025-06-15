<?php
if (isset($_POST['submit'])) {
    // Conexión a la base de datos usando TCP/IP para evitar error de socket
$conn = new mysqli('localhost', 'root', '', 'stl_database');
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Sanitizar entradas para mayor seguridad (opcional, pero recomendado)
    $full_name = $conn->real_escape_string(trim($_POST['full_name']));
    $student_id = $conn->real_escape_string(trim($_POST['student_id']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $department = $conn->real_escape_string(trim($_POST['department']));
    $team_selected = $conn->real_escape_string(trim($_POST['team_selected']));
    $motivation = $conn->real_escape_string(trim($_POST['motivation']));

    // Procesar archivo CV
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        // Evitar conflictos en nombres con un prefijo único, ej: timestamp + nombre original
        $cv_name = time() . '_' . basename($_FILES['cv']['name']);
        $cv_tmp = $_FILES['cv']['tmp_name'];
        $destination = __DIR__ . '/uploads/' . $cv_name;

        // Crear carpeta uploads si no existe
        if (!is_dir(__DIR__ . '/uploads')) {
            mkdir(__DIR__ . '/uploads', 0755, true);
        }

        if (!move_uploaded_file($cv_tmp, $destination)) {
            die("Error moving uploaded file.");
        }
    } else {
        die("Error uploading CV file. Error code:" . $_FILES['cv']['error']);
    }

    // Insertar en la base de datos con consulta preparada
    $sql = "INSERT INTO applications (full_name, student_id, email, department, cv_filename, team_selected, motivation)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $full_name, $student_id, $email, $department, $cv_name, $team_selected, $motivation);

    if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Application sent!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error al guardar la aplicación: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Apply</title>
  <link rel="stylesheet" href="../css/apply.css" />
  <link rel="stylesheet" href="apply.css?v=2">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="conte-body">

    <div class="conte-header">
      <div class="subcon1-0">STL<span class="highlight">club</span></div>
      <div class="menu">
          <div class="caja"><a href="../index.php">Home</a></div>
        <div class="caja"><a href="post.php">Post</a></div>
        <div class="caja"><a href="apply.php">Apply</a></div>
        <div class="caja"><a href="about.php">About Us</a></div>
        <div class="caja"><a href="login.php">Login</a></div>
        
      </div>
    </div>

    <div class="step-container">
      <h2 class="step-title">Applications Forms</h2>

      <div class="step-progressbar">
        <div class="step-wrapper"><div class="step active">1</div><div class="step-label">Step 1</div></div>
        <div class="step-wrapper"><div class="step">2</div><div class="step-label">Step 2</div></div>
        <div class="step-wrapper"><div class="step">3</div><div class="step-label">Step 3</div></div>
      </div>

      <!-- Formulario -->
      <form id="formSteps" method="POST" enctype="multipart/form-data" action="apply.php">
        <!-- Paso 1 -->
        <div class="step-form step-form-active">
          <h3>Basic Information</h3>

          <label>Full Name</label>
          <input type="text" name="full_name" placeholder="Full Name..." required>

          <label>Student ID</label>
          <input type="text" name="student_id" placeholder="Type your ID number..." required>

          <label>Email</label>
          <input type="email" name="email" placeholder="Type your email..." required>

          <label>Department</label>
          <input type="text" name="department" placeholder="Type your Department..." required>

          <label>CV</label>
          <div class="file-input-container">
            <label class="file-input-label" for="cv">Select CV file</label>
            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,image/*" required>
          </div>

          <label for="team">List Team</label>
          <div class="select-wrapper">
            <select id="team" name="team_selected" required>
              <option value="">Select</option>
              <option value="engineering">System Division</option>
              <option value="design">Design</option>
              <option value="Structure">Structure</option>
              <option value="Avionic">Avionic</option>
              <option value="Propulsion">Propulsion</option>
              <option value="Parachute">Parachute</option>
            </select>
          </div>
        </div>

        <!-- Paso 2 -->
        <div class="step-form">
          <h3>More Info</h3>
          <label>Why do you want to join?</label>
          <textarea name="motivation" placeholder="Explain your motivation..." required></textarea>
        </div>

        <!-- Botones -->
        <div class="buttons">
          <button type="button" id="prevBtn">Previous</button>
          <button type="button" id="nextBtn">Next</button>
          <button type="submit" name="submit" id="submitBtn" style="display: none;">Submit</button>
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

  <script src="../js/apply.js"></script>

</body>
</html>