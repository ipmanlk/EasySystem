<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy System : Deliver</title>
  <link rel="stylesheet" href="./res/css/bootstrap.min.css">
</head>
<body>
  <?php
  require_once './tasks/checkSession.php';
  require_once './res/content/navBar.php';
  ?>

  <div class="container mt-2">
    <div class="row">
      <div class="col-md-2"></div>

      <div class="col-md-8 col-sm-12">

        <div class="card">
          <div class="card-header">Deliver Item</div>
          <div class="card-body">
            <form method="post" id="deliverItemForm">
              <div class="form-group">
                <label for="itemID">Item ID (*):</label>
                <input type="text" class="form-control" id="itemID" name="itemID" maxlength="20">
                <ul class="list-group" id="itemIDSuggestions">

                </ul>
              </div>
              <div class="form-group">
                <label for="qty">Qty (*):</label>
                <input type="number" class="form-control" id="qty" name="qty" maxlength="10">
              </div>
              <div class="form-group">
                <label for="itemDes">Deliver Note:</label>
                <input type="text" class="form-control" id="dNote" name="dNote" maxlength="20">
              </div>
              <div class="form-group">
                <label for="stockingUM">MRN:</label>
                <input type="text" class="form-control" id="mrn" name="mrn" maxlength="20">
              </div>
              <div class="form-group">
                <label for="partNum">Location:</label>
                <input type="text" class="form-control" id="location" name="location" maxlength="200">
                <ul class="list-group" id="locationSuggestions">

                </ul>
              </div>

              <button id="deliverItemBtn" type="submit" onclick="deliverItem();" class="btn btn-primary">Deliver Item</button>
              <div style="display:none;" class="alert alert-success mt-3" id="deliverItemOutput">

              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>

    </div>
  </div>

  <!-- scripts -->
  <script src="./res/js/jquery-3.3.1.min.js" charset="utf-8"></script>
  <script src="./res/js/bootstrap.min.js" charset="utf-8"></script>

  <script type="text/javascript">

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
  </script>
</body>
</html>
