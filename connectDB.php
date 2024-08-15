<?php

$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DBNAME);
if ($conn->connect_error) {
    die("Connect Error: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
