<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy System : Receive Report</title>
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
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item Description</th>
              <th>Receive Date & Time</th>
              <th>Qty</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require_once("./setup/config.php");
            $result=mysqli_query($link,"SELECT stock.itemID, stock.itemDes, r.dateTime, r.qty FROM item_stock stock, item_received r WHERE r.itemID = stock.itemID");
            while ($row=mysqli_fetch_array($result)) {
              echo '<tr>';
              echo '<td>' . $row['itemID'] . '</td>';
              echo '<td>' . $row['itemDes'] . '</td>';
              $dateTime= new DateTime($row['dateTime']);
              $dateTime->setTimezone(new DateTimeZone('Asia/Colombo'));
              $lkDateTime =  $dateTime->format('Y-m-d - g:i A');
              echo '<td>' . $lkDateTime . '</td>';
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.js"></script>
  <script type="text/javascript">
  // data table settings
  $(document).ready(function() {
    $('.table').DataTable( {
      dom: 'Bfrtip',
      buttons: ['pdf','excel','print'],
      responsive: true
    } );
  } );
  </script>
</body>
</html>
