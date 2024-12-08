<?php
$conn = new mysqli('localhost', 'root', '', 'inspec');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
?>