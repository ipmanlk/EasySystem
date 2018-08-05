<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy System : Reports</title>
  <link rel="stylesheet" href="./res/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./res/DataTables/datatables.min.css"/>
</head>
<body>
  <?php require_once './res/content/navBar.php'; ?>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Location</th>
              <th>Deliver Date & Time</th>
              <th>Deliver Note</th>
              <th>MRN</th>
              <th>Qty</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require_once("./setup/config.php");
            $result=mysqli_query($link,"SELECT stock.itemID, d.location, d.dateTime, d.qty, d.dNote, d.mrn, d.location FROM item_stock stock, item_delivered d WHERE stock.itemID = d.itemID");
            while ($row=mysqli_fetch_array($result)) {
              echo '<tr>';
              echo '<td>' . $row['itemID'] . '</td>';
              echo '<td>' . $row['location'] . '</td>';
              echo '<td>' . $row['dateTime'] . '</td>';
              echo '<td>' . $row['dNote'] . '</td>';
              echo '<td>' . $row['mrn'] . '</td>';
              echo '<td>' . $row['qty'] . '</td>';
              echo '</tr>';
            }
            mysqli_close($link);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="./res/js/jquery-3.3.1.min.js" charset="utf-8"></script>
  <script src="./res/js/bootstrap.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="./res/DataTables/datatables.min.js"></script>
  <script src="./res/js/items.js" charset="utf-8"></script>
</body>
</html>
