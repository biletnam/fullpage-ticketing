<?php
  include "db.php";

  $sql = "SELECT pricing.stage,pricing.price FROM pricing WHERE (expiration >= NOW()) AND ((pricing.left > 0) OR (pricing.left IS NULL)) ORDER BY pricing.priority LIMIT 1";

  if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
  }

  while($row = $result->fetch_assoc()){
    echo $row['stage']."-€".$row['price'].'<br />';
  }

  if($_SERVER['REQUEST_METHOD'] ==  "GET") {
    if(isset($_GET['reserve'])) {
      echo "true";
    }
  }
 ?>
