<?php
  include "db.php";

  if($_SERVER['REQUEST_METHOD'] ==  "GET") {

    if(isset($_GET['cart'])) {
      //////get cheapest possible price
      $sql = "SELECT pricing.stage,pricing.name,pricing.price FROM pricing WHERE (pricing.expiration >= NOW()) AND ((pricing.left > 0) OR (pricing.left IS NULL)) ORDER BY pricing.priority LIMIT 1";
      $row = $db->query($sql)->fetch_assoc();
      //echo $row['stage']."-€".$row['price'];

      //////decrease number of avaible tickets
      $sql = "UPDATE pricing SET pricing.left = IFNULL((pricing.left - 1), NULL) WHERE pricing.stage = ".$row['stage']." AND stage > 0";

      if(!$result = $db->query($sql)){
        die('There was an error running the update query [' . $db->error . ']');
      }
      //////add ticket to cart
      ////generate uid
      $uid = md5($row['stage'].$row['price'].rand().$row['price'].microtime()).$row['stage'].$row['price'];

      $sql = "INSERT INTO carted (uid, stage, price) VALUES ('".$uid."', ".$row['stage'].", '".$row['price']."')";
      if(!$result = $db->query($sql)){
        die('There was an error running the insert query [' . $db->error . ']');
      }

      echo "{\"uid\":\"".$uid."\", \"price\":".$row['price'].", \"stage\":{\"id\":".$row['stage'].", \"name\":\"".$row['name']."\"}}";
    } else if (isset($_GET['remove'])) {
      $uidstring  = $db->real_escape_string(htmlspecialchars($_GET['remove']));

      $uids = explode("-", $uidstring);

      $success = true;

      foreach($uids as $uid) {

        ///////get price class of returned card
        $sql = "SELECT carted.stage FROM carted WHERE carted.uid = '".$uid."'";

        if(!$result = $db->query($sql)){
          $success = false;
        }

        $row = $result->fetch_assoc();

        //////delete reservation
        $sql = "DELETE FROM carted WHERE carted.uid = '".$uid."'";

        if(!$result = $db->query($sql)){
          $success = false;
        }

        //////make this ticket reavaible
        $sql = "UPDATE pricing SET pricing.left = IFNULL((pricing.left + 1), NULL) WHERE pricing.stage = ".$row['stage'];

        if(!$result = $db->query($sql)){
          $success = false;
        }
      }

      echo "{\"success\":\"".($success?"true":"false")."\"}";

    }
  }
 ?>
