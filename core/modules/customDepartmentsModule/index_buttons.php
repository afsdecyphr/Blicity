<?php
$connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$result = $connection->query("SELECT * FROM customdepartmentsmodule");
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<a href="#mdt" class="btn btn-primary form-control" data-toggle="modal" data-target="#mdtModal" style="margin-top:10px;width:90%; margin: 5px auto;display: block;">' . $row['depName'] . '</a>';
  }
} else {
  echo "0 results";
}
$connection->close();
?>
