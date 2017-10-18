$(document).ready(function() {

  /** creates first ticket
  */
  var createFirstTicketButtonClicked = false;
  $("#createFirstTicket").click(function() {
    $("#name-ticket1").val($("#input-firstname").val() + " " + $("#input-surname").val());
    if(!createFirstTicketButtonClicked) {
      //generate uid for first ticket
      $.getJSON("ticket_reservation.php?cart", function(ticket) {
        $("#name-ticket1").next().val(ticket.uid);
        createFirstTicketButtonClicked = true;
      });
    }
  });

  /** Creates the review page
  */
  $("#createReviewPage").click(function() {
    $("#reviewTable").empty();
    $(".ticketOrder").each(function () {
      var uid = $(this).next().val();/*hardcoded for 4 digit prices*/
      var displayPrice = uid.substring(uid.length-4, uid.length);
      var priceClass = uid.substring(uid.length-5, uid.length-4);
      $("#reviewTable").prepend("<tr><td class='reviewName'>"+$(this).val()+"<br>"+priceClass+"</td><td class='reviewPrice'>€"+displayPrice+"<br>"+uid+"</td></tr>");
    });
  });

  /** Button to continue the order process
  */
  $(".backbutton").click(function() {
    $.fn.fullpage.moveSlideLeft();
  });
  $(".nextbutton").click(function() {
    $.fn.fullpage.moveSlideRight();
  });

  /** Button to add a ticket
  */
  var tickets = 1;
  $("#addticketbutton").click(function() {
    $.getJSON("ticket_reservation.php?cart", function(ticket) {
      tickets++;
      $("#addticketbutton").before('<input required type="text" class="wide ticketOrder" id="name-ticket'+ tickets +'" name="tickets[owner][]" placeholder="z.B. Max Mustermann"><input type="hidden" name="tickets[uids][]" value="'+ticket.uid+'"><button type="button" class="removeTicketButton">-</button><br>');
    });
  });

  /** Button to remove a ticket
  */
  $("#step2").on("click", ".removeTicketButton", function() {
    var button = $(this);
    var uid = button.prev().val();

    $.getJSON("ticket_reservation.php?remove="+uid, function(ticket) {
      tickets--;
      button.prev().remove(); //uid
      button.prev().remove(); //owner
      button.next().remove(); //br
      button.remove(); //this
    });
  });
});
