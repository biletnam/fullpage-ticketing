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
    var totalPrice = 0;
    var content = "";
    $(".ticketOrder").each(function () {
      var uid = $(this).next().val();
      var thisThing = $(this);

      //deprecated but had no better idea at the time
      $.ajax({
        dataType: "json",
        async: false,
        url: "cart_info.php?uid="+uid,
        success: function(ticket) {
          totalPrice += Number(ticket.price)/100;
          content += "<tr><td class='reviewName'>"+thisThing.val()+"<br>"+ticket.stage.name+"</td><td class='reviewPrice'>€"+ticket.price/100+"<br>"+uid+"</td></tr>";
        }
      });

    });
    content += "<tr class='totalRow'><td class='reviewName totalName'>Gesamt</td><td class='totalPrice reviewPrice'>€"+totalPrice+"</td></tr>";
    $("#reviewTable").append(content);
  });

  /** Button to continue the order process
  */
  $(".scrollDown").click(function() {
    $.fn.fullpage.moveSectionDown();
  });
  $(".backbutton").click(function() {
    $.fn.fullpage.moveSlideLeft();
  });
  $(".nextbutton").click(function() {
    var pageValid = true;

    $(this).parent().children("input").each(function() {
      if(!$(this)[0].checkValidity()) {
        pageValid = false;
      }
    });

    if(pageValid) {
      $.fn.fullpage.moveSlideRight();
    } else {
      // If the form is invalid, submit it. The form won't actually submit;
      // this will just cause the browser to display the native HTML5 error messages.
      $("form").find(":submit").click();
    }
  });

  /** Button to add a ticket
  */
  var tickets = 1;
  $("#addticketbutton").click(function() {
    $.getJSON("ticket_reservation.php?cart", function(ticket) {
      tickets++;
      $("#addticketbutton").before('<input required type="text" class="wide ticketOrder" id="name-ticket'+ tickets +'" name="tickets[owner][]" placeholder="z.B. Max Mustermann"><input type="hidden" name="tickets[uids][]" value="'+ticket.uid+'"><button tabindex="-1" type="button" class="removeTicketButton">-</button><br>');
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

$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});
