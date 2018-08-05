<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy System : Stock Items</title>
  <link rel="stylesheet" href="./res/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.css"/>
</head>
<body>
  <?php
  require_once './tasks/checkSession.php';
  require_once './res/content/navBar.php';
  ?>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12 mb-4">
        <button type="button" class="btn btn-warning" onclick="receiveItems();">Receive Item Stock</button>
        <button type="button" class="btn btn-success" onclick="addItems();">Add New Item</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item Description</th>
              <th>Stocking U/M</th>
              <th>Part Number</th>
              <th>Qty on Hand</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
            <?php
            require_once("./setup/config.php");
            $result=mysqli_query($link,"SELECT * FROM item_stock");
            while ($row=mysqli_fetch_array($result)) {
              echo '<tr>';
              echo '<td>' . $row['itemID'] . '</td>';
              echo '<td>' . $row['itemDes'] . '</td>';
              echo '<td>' . $row['stockingUM'] . '</td>';
              echo '<td>' . $row['partNum'] . '</td>';
              echo '<td>' . $row['qty'] . '</td>';
              echo '<td>' .
              '<button type="button" class="btn btn-primary" onclick="editItem(' ."'" . $row['itemID'] . "'". ')">Edit</button>'
              .
              '<button type="button" class="btn btn-danger ml-2" onclick="deleteItem(' ."'" . $row['itemID'] . "'". ')">Delete</button>'
              . '</td>';
              echo '</tr>';
            }
            mysqli_close($link);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- add items -->
  <div class="modal fade" id="addItemModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Items</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <form method="post" id="addItemModalForm">
            <div class="form-group">
              <label for="itemID">Item ID (*):</label>
              <input type="text" class="form-control" id="itemID" name="itemID" maxlength="20">
            </div>
            <div class="form-group">
              <label for="itemDes">Item Description:</label>
              <input type="text" class="form-control" id="itemDes" name="itemDes" maxlength="200">
            </div>
            <div class="form-group">
              <label for="stockingUM">Stocking U/M:</label>
              <input type="text" class="form-control" id="stockingUM" name="stockingUM" maxlength="20">
            </div>
            <div class="form-group">
              <label for="partNum">Part Number:</label>
              <input type="text" class="form-control" id="partNum" name="partNum" maxlength="20">
            </div>
            <div class="form-group">
              <label for="qty">Qty on Hand(*):</label>
              <input type="number" class="form-control" id="qty" name="qty" maxlength="10">
            </div>
            <button id="addItemBtn" onclick="addItem();" class="btn btn-primary">Add New Item</button>
            <button id="updateItemBtn" style="display:none" onclick="updateItem();" class="btn btn-warning">Update Item</button>

            <div style="display:none;" class="alert alert-success mt-3" id="addItemModalOutput">

            </div>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- confirm modal -->
  <div class="modal fade" id="confirmModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Do you really want to delete this item?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button id="confirmDelete" type="button" class="btn btn-danger">Yes, Delete!</button>
        </div>

      </div>
    </div>
  </div>

  <!-- receive modal -->

  <!-- add items -->
  <div class="modal fade" id="receiveItemModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Item Qty to Stock</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <form method="post" id="receiveItemModalForm">
            <div class="form-group">
              <label for="receiveItemID">Item ID (*):</label>
              <input type="text" class="form-control" id="receiveItemID" name="receiveItemID" maxlength="20">
              <ul class="list-group" id="receiveItemIDSuggestions">

              </ul>
            </div>

            <div class="form-group">
              <label for="receiveQty">Qty (*):</label>
              <input type="number" class="form-control" id="receiveQty" name="receiveQty" maxlength="10">
            </div>

            <button id="receiveItemBtn" onclick="receiveItem();" class="btn btn-primary">Receive Item Stock</button>

            <div style="display:none;" class="alert alert-success mt-3" id="receiveItemModalOutput">

            </div>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="./res/js/jquery-3.3.1.min.js" charset="utf-8"></script>
  <script src="./res/js/bootstrap.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.js"></script>
  <script src="./res/js/items.js" charset="utf-8"></script>
</body>
</body>
</html>
