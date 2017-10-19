<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Silvester Kartensuff</title>
  </head>
  <body>
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>");
      } else {
        die("error");
      }
     ?>
  </body>
</html>
