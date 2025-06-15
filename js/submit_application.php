<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$conn = new mysqli('localhost', 'root', '', 'stl_database');
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $full_name = $_POST['full_name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $team_selected = $_POST['team_selected'];
    $motivation = $_POST['motivation'];

    $cv_name = $_FILES['cv']['name'];
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $destination = 'uploads/' . $cv_name;
    move_uploaded_file($cv_tmp, $destination);

    $sql = "INSERT INTO applications (full_name, student_id, email, department, cv_filename, team_selected, motivation)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $full_name, $student_id, $email, $department, $cv_name, $team_selected, $motivation);
    $stmt->execute();

    echo "<p style='color: green; text-align: center;'>¡Application submitted successfully!</p>";
    $stmt->close();
    $conn->close();
}
?>