<?php
session_start();
session_unset();
session_destroy();

// Redirect to STLweb/index.php
header("Location: ../index.php");
exit;
?>