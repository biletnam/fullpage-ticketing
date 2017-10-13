$(document).ready(function() {
  /** Names the first ticket after the orderer
  */
  $("#createFirstTicket").click(function() {
    $("#name-ticket1").val($("#input-firstname").val() + " " + $("#input-surname").val());
  });

  /** Creates the review page
  */
  $("#createReviewPage").click(function() {
    $("#reviewTable").empty();
    $(".ticketOrder").each(function () {                                                                        /*hardcoded for 2 digit prices*/
      $("#reviewTable").prepend("<tr><td class='reviewName'>"+$(this).val()+"<br>Early-Bird Ticket</td><td class='reviewPrice'>€20</td></tr>");
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
    tickets++;
    $(this).before('<input type="text" class="wide ticketOrder" id="name-ticket'+ tickets +'" name="tickets[]" placeholder="z.B. Max Mustermann"><input type="hidden" name="tickets[uids][]" value="88fasodfho72as7asd2asdoier"><button type="button" class="removeTicketButton">-</button><br>');
  });

  /** Button to remove a ticket
  */
  $("#step2").on("click", ".removeTicketButton", function() {
    tickets--;
    $(this).prev().remove(); //owner
    $(this).prev().remove(); //uid
    $(this).next().remove(); //br
    $(this).remove(); //this
  });
});
