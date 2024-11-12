<?php 
function retrieveAllFrom($tableName) {
    global $conn;
    $sql = "SELECT * FROM $tableName ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getUserByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}