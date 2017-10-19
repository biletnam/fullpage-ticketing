<?php
  include "db.php";

  if($_SERVER['REQUEST_METHOD'] ==  "GET") {

    if(isset($_GET['uid'])) {
      $uid  = $db->real_escape_string(htmlspecialchars($_GET['uid']));

      $sql = "SELECT carted.stage,carted.price FROM carted WHERE carted.uid = '".$uid."'";
      $row = $db->query($sql)->fetch_assoc();

      $stage = $row['stage'];
      $price = $row['price'];

      $sql = "SELECT pricing.name FROM pricing WHERE pricing.stage = '".$stage."'";
      $row = $db->query($sql)->fetch_assoc();

      echo "{\"uid\":\"".$uid."\", \"price\":".$price.", \"stage\":{\"id\":".$stage.", \"name\":\"".$row['name']."\"}}";
    }
  }
?>
