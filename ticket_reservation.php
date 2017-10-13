<?php
  include "db.php";

  $sql = "SELECT pricing.stage,pricing.price FROM pricing WHERE pricing.left <> 0 LIMIT 1";
  //$sql = "SELECT * FROM pricing WHERE pricing.left = '60'";

  if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
  }

  while($row = $result->fetch_assoc()){
    echo $row['stage']."-€".$row['price'].'<br />';
  }
 ?>
