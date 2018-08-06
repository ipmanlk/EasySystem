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
          <div class="card-header"><h4>Deliver Item</h4></div>
          <div class="card-body">
            <form method="post" id="deliverItemForm" autocomplete="off">
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
  <script src="./res/js/deliver.js" charset="utf-8"></script>
</body>
</html>
