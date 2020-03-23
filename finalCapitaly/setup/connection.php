<?php
$conn = new mysqli("localhost","root","","capitaly");

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>