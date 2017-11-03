<?php include "db.php" ?>
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

        if($_POST['firstname'] !=  "" && $_POST['surname'] != "" && $_POST['email'] != "" && $_POST['mobile'] != "" && count($_POST['tickets']['owner']) > 0) {
          $firstname = $db->real_escape_string(htmlspecialchars($_POST['firstname']));
          $surname = $db->real_escape_string(htmlspecialchars($_POST['surname']));
          $email = $db->real_escape_string(htmlspecialchars($_POST['email']));
          $mobile = $db->real_escape_string(htmlspecialchars($_POST['mobile']));

          $sql = "SELECT carted.uid, carted.stage, carted.price FROM carted WHERE";

          $tickets = count($_POST['tickets']['owner']);

          for($i = 0; $i<$tickets; $i++) {
            $sql = $sql.($i>0?" OR":"")." carted.uid = '".$db->real_escape_string(htmlspecialchars($_POST['tickets']['uids'][$i]))."'";
          }

          //DEBUG pls remove
          echo $sql."<br>";

          if(!$result = $db->query($sql)){
            die('There was an error selecting the tickets [' . $db->error . ']');
          }

          if($result->num_rows == count($_POST['tickets']['owner'])) {

          } else {
            die("ERROR invalid tickets: entweder sind deine tickets abgelaufen oder wurden manipuliert");
          }

        } else {
          die("ERROR invalid request");
        }


      } else {
        die("ERROR WRONG REQUEST_METHOD");
      }
     ?>

     <br><br><br>

     //check if uids are valid (if they're in carted they're valid) $result->num_rows

     //add record for new order
     //       $db->insert_id


     /*
     delete from rooms
     where room_initiating_user_id in (select user_id from users where user_connected = 0)
  and room_target_user_id in (select user_id from users where user_connected = 0)
     */
  </body>
</html>
