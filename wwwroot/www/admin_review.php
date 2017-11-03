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

          if(!$result = $db->query($sql)){
            die('There was an error selecting the tickets [' . $db->error . ']');
          }

          if($result->num_rows == count($_POST['tickets']['owner'])) {
              echo "valid";

              //TODO: check if order for this id is already placed (because of reload)

              //create new order (add a row to order with name etc) --> note id
              $ordsql = "INSERT INTO orders (orders.firstname, orders.surname, orders.email, orders.mobile, orders.date_placed, orders.admin_reviewed) VALUES ('".$firstname."', '".$surname."', '".$email."', '".$mobile."', NOW(), 0)";

              if(!$ordresult = $db->query($ordsql)){
                die('There was an error creating the order [' . $db->error . ']'); //latest change here
              }

              $orderid = $db->insert_id;

              //create tickets
              while($row =  $result->fetch_assoc()){

                $ticksql = "INSERT INTO tickets (tickets.uid, tickets.order, tickets.name, tickets.stage, tickets.price, tickets.approved) VALUES ('".$row['uid']."', '".$orderid."', '".$_POST['tickets']['owner'][array_search($row['uid'], $_POST['tickets']['uids'])]."', ".$row['stage'].", ".$row['price'].", 0)";

                if(!$tickresult = $db->query($ticksql)){
                  die('There was an error creating the order [' . $db->error . ']'); //latest change here
                }

              }

              //remove tickets from carted (because they are dispatched now)
              $sql = "DELETE FROM carted WHERE";

              for($i = 0; $i<$tickets; $i++) {
                $sql = $sql.($i>0?" OR":"")." carted.uid = '".$db->real_escape_string(htmlspecialchars($_POST['tickets']['uids'][$i]))."'";
              }

              if(!$result = $db->query($sql)){
                die('There was an error removing the tickets from carted [' . $db->error . ']');
              }
          } else {
            die("ERROR invalid tickets: entweder sind deine tickets abgelaufen oder wurden manipuliert");
          }

        } else {
          die("ERROR missing data");
        }
      } else {
        die("ERROR WRONG REQUEST_METHOD");
      }
     ?>
  </body>
</html>
