<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if (isset($_POST['getFishingLicense'])) {
  $uuid = $_GET['getFishingLicense'];
  if ($uuid == "1") {
    $uuid = $_SESSION['identifier'];
  }
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  
  $result = $connection->query("SELECT fishingLicense FROM characters WHERE uuid='$uuid'");
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo $row['fishingLicense'];
      exit();
    }
  }
} elseif (isset($_POST['getHuntingLicense'])) {
  $uuid = $_GET['getHuntingLicense'];
  if ($uuid == "1") {
    $uuid = $_SESSION['identifier'];
  }
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  
  $result = $connection->query("SELECT huntingLicense FROM characters WHERE uuid='$uuid'");
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo $row['huntingLicense'];
      exit();
    }
  }
} elseif (isset($_POST['updateFishingLicense']) && isset($_POST['status'])) {
  $uuid = $_GET['updateFishingLicense'];
  $status = $_GET['status'];
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  
  $result = $connection->query("UPDATE characters SET fishingLicense='$status' WHERE uuid='$uuid'");
  echo "success";
  exit();
} elseif (isset($_POST['updateHuntingLicense']) && isset($_POST['status'])) {
  $uuid = $_GET['updateHuntingLicense'];
  $status = $_GET['status'];
  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  
  $result = $connection->query("UPDATE characters SET huntingLicense='$status' WHERE uuid='$uuid'");
  echo "success";
  exit();
} else {
  echo "unknownFunction";
  exit();  
}
?>