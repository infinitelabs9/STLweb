download the database mainly import it to mysql, and give the user permissions in mysql, after that you would connect to the database, and you can do whatever you want as an interaction.

$dbname = 'stl_database';
$username = 'root';
$password = '';

$conn = new mysqli('localhost', 'root', '', 'stl_database');
