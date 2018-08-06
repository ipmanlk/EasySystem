$(document).ready(function() {
  submit();
} );

function submit() {
  $("#deliverItemForm").submit(function(e) {
    e.preventDefault();
  });
}

function deliverItem() {
  $.ajax({
    type: 'POST',
    url: './tasks/deliverItem.php',
    data: $('form').serialize(),
    dataType: "html",
    async: true,
    success: function(msg) {
      $("#deliverItemOutput").fadeIn();
      if (msg == 1) {
        showOutputMsg("good","Deliver completed.");
        $('form').find('input').val('');
      } else if (msg == 2) {
        showOutputMsg("bad","Item ID not found!.");
      } else if(msg ==3){
        showOutputMsg("bad","Input details are missing!.");
      } else {
        showOutputMsg("bad","Stock is low!.");
      }
    }
  });
}

//show suggestions
$('#itemID').on('input propertychange', function(){
  $('#itemIDSuggestions').empty();
  suggestItemIDs();
});

function suggestItemIDs() {
  if (notEmpty($('#itemID').val())) {
    $.get("./tasks/suggestItemID.php?itemID=" + $('#itemID').val(), function(data) {
      const itemIDs = JSON.parse(data);
      if (itemIDs[0] !== null) {
        for (item in itemIDs) {
          $('#itemIDSuggestions').append(`<a href="#"><li class="list-group-item" onclick="setItemID('${itemIDs[item]}')">${itemIDs[item]}</li></a>`);
        }
      }
    });
  }
}

function setItemID(val) {
  $('#itemID').val(val);
  $('#itemIDSuggestions').empty();
}



$('#location').on('input propertychange', function(){
  $('#locationSuggestions').empty();
  suggestLocations();
});

function suggestLocations() {
  if (notEmpty($('#location').val())) {
    $.get("./tasks/suggestLocations.php?location=" + $('#location').val(), function(data) {
      const locations = JSON.parse(data);
      if (locations[0] !== null) {
        for (item in locations) {
          $('#locationSuggestions').append(`<a href="#"><li class="list-group-item" onclick="setLocation('${locations[item]}')">${locations[item]}</li></a>`);
        }
      }
    });
  }
}

function setLocation(val) {
  $('#location').val(val);
  $('#locationSuggestions').empty();
}

//check values is not null & empty
function notEmpty(val) {
  if (val !== null && val!=="") {
    return true;
  } else {
    return false;
  }
}

//show output msg
function showOutputMsg(type,msg) {
  if (type == "bad") {
    $("#deliverItemOutput").removeClass("alert-success");
    $("#deliverItemOutput").addClass("alert-danger");
  } else {
    $("#deliverItemOutput").removeClass("alert-danger");
    $("#deliverItemOutput").addClass("alert-success");
  }
  $("#deliverItemOutput").text(msg);
  $("#deliverItemOutput").fadeIn();
}

//hide output alerts when user type on input field
$('input').on('keyup', function(){
  $("#deliverItemOutput").fadeOut();
});
