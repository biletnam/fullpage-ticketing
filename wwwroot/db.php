<?php
  include "creds.php";

  $db = new mysqli($mysql["host"], $mysql["user"], $mysql["pass"], $mysql["db"], $mysql["port"]);
  $db->set_charset('utf8');


 ?>
