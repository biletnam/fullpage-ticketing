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

        <form action="/order_review.php">


          <div class="slide" data-anchor="customerData">
            <div id="step1" class="content">
              <input type="text" class="trelevant small left" id="input-firstname" name="firstname" placeholder="Vorname">
              <input type="text" class="trelevant small right" id="input-surname" name="surname" placeholder="Nachname"><br>
              <input type="email" class="wide" id="input-email" name="email" placeholder="E-Mail Adresse"><br>
              <button type="button" id="createFirstTicket" class="small right nextbutton">Weiter</button>
            </div>
          </div>

        	<div class="slide" data-anchor="ticketSelection">
            <div id="step2" class="content">
              <input type="text" class="wide ticketOrder" id="name-ticket1" name="tickets[]" disabled><button type="button" class="removeTicketButton">-</button><br>
              <button type="button" id="addticketbutton" class="wide">Ticket hinzufügen</button><br>
              <button type="button" class="small left backbutton">Zurück</button>
              <button type="button" id="createReviewPage" class="small right nextbutton">Weiter</button>
            </div>
          </div>

        	<div class="slide" data-anchor="review">
            <div id="step3" class="content">
              <table id="reviewTable">
              </table>
              <button type="button" class="small left backbutton">Zurück</button>
              <input type="submit" class="small right" value="Abschicken">
            </div>
          </div>

        </form>

      </div>

    </div>
  </body>
</html>
