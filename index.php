<?php
include "db.php";

$sql = "SELECT carted.id, carted.stage FROM carted WHERE (NOW() - INTERVAL 30 MINUTE) > carted.time_carted";

while($row = $db->query($sql)->fetch_assoc()){
    //echo $row['id'];
    $sql2 = "UPDATE pricing SET pricing.left = IFNULL((pricing.left + 1), NULL) WHERE pricing.stage = ".$row['stage'];
    $sql3 = "DELETE FROM carted WHERE carted.id = ".$row['id'];
    $db->query($sql2);
    $db->query($sql3);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Silvester Kartensuff</title>

    <link rel="stylesheet" type="text/css" href="lib/fullPage/jquery.fullpage.min.css" />

    <link rel="stylesheet" type="text/css" href="css/main.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/fullPage/jquery.fullpage.min.js"></script>

    <script type="text/javascript" src="js/init.js"></script>
    <script type="text/javascript" src="js/handles.js"></script>
  </head>
  <body>
    <div id="fullpage">

      <div class="section">
        moin moin auf der silvester seite
        <a href="#order/customer">tickets anfordern</a>
      </div>

    	<div class="section">

        <form action="admin_review.php" method="POST">


          <div class="slide" data-anchor="customerData">
            <div id="step1" class="content">
              <input required type="text" class="trelevant small left" id="input-firstname" title="Vorname" name="firstname" placeholder="Vorname">
              <input required type="text" class="trelevant small right" id="input-surname" title="Nachname" name="surname" placeholder="Nachname"><br>
              <input required type="email" class="wide" id="input-email" name="email" title="E-Mail Adresse" placeholder="E-Mail Adresse"><br>
              <input required type="tel" pattern="[0-9]*\/*(\+49)*[ ]*(\([0-9]+\))*([ ]*(-|–)*[ ]*[0-9]+)*" title="Handynummer" class="wide" id="input-mobile" name="mobile" autocomplete="tel" placeholder="Handynummer (für weitere Fragen)"><br>
              <button type="button" id="createFirstTicket" class="small right nextbutton">Weiter</button>
              <br>wenn du mehr als 30 minuten brauchst, bist du am arsch
            </div>
          </div>

        	<div class="slide" data-anchor="ticketSelection">
            <div id="step2" class="content">
              <input type="text" class="wide ticketOrder" id="name-ticket1" name="tickets[owner][]" readonly><input type="hidden" name="tickets[uids][]" value="null"><button tabindex="-1" type="button" class="removeTicketButton">-</button><br>
              <button type="button" id="addticketbutton" class="wide">Ticket hinzufügen</button><br>
              <button tabindex="-1" type="button" class="small left backbutton">Zurück</button>
              <button type="button" id="createReviewPage" class="small right nextbutton">Weiter</button>
            </div>
          </div>

        	<div class="slide" data-anchor="review">
            <div id="step3" class="content">
              <table id="reviewTable">
              </table>
              <button tabindex="-1" type="button" class="small left backbutton">Zurück</button>
              <input type="submit" class="small right" value="Abschicken" />
            </div>
          </div>

        </form>

      </div>

    </div>
  </body>
</html>
