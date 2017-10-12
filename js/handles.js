$(document).ready(function() {
  /** Names the first ticket after the orderer
  */
  $("#createFirstTicket").click(function() {
    $("#name-ticket1").val($("#input-firstname").val() + " " + $("#input-surname").val());
  });

  /** Creates the review page
  */
  $("#createReviewPage").click(function() {
    //$("#reviewTable").prepend("<tr><td>"++"</td></tr>");
    $("ticketOrder").each(function () {
      alert($(this).val());
    });
  });
/*
  $("ticketOrder").each(function () {

      $('td', this).each(function () {
          var value = $(this).find(":input").val();
          var values = 100 - value + ', ' + value;

          if (value > 0) {
              $(this).append(htmlPre + values + htmlPost);
          }
       })

  })
*/

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
    $(this).before('<input type="text" class="wide ticketOrder" id="name-ticket'+ tickets +'" name="tickets[]" placeholder="z.B. Max Mustermann"><button type="button" class="removeTicketButton">-</button><br>');
  });

  /** Button to remove a ticket
  */
  $("#step2").on("click", ".removeTicketButton", function() {
    tickets--;
    $(this).prev().remove();
    $(this).next().remove();
    $(this).remove();
  });
});
