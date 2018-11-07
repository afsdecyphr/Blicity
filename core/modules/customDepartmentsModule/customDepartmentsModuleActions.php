<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if (isset($_GET['getDepartments'])) {
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }
  $result = $connection->query("SELECT * FROM customdepartmentsmodule");
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo '<tr><td>' . $row['depName'] . '</td><td><button class="btn btn-sm btn-danger" onclick="deleteDepartment(' . "'" . $row['id'] . "'" . ');">Delete</button></td></tr>';
    }
  }
  exit();
} if (isset($_GET['createDepartment'])) {
  $name = $_GET['createDepartment'];
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }
  $result = $connection->query("INSERT INTO customdepartmentsmodule VALUES (DEFAULT, '$name')");
  echo "success";
  exit();
} if (isset($_GET['deleteDepartment'])) {
  $id = $_GET['deleteDepartment'];
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }
  $result = $connection->query("DELETE FROM customdepartmentsmodule WHERE id='$id'");
  echo "success";
  exit();
} else {
  echo "unknownFunction";
  exit();
}
?>