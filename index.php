<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy System : Index</title>
  <link rel="stylesheet" href="./res/css/bootstrap.min.css">
</head>
<body>
 <?php require_once './res/content/navBar.php'; ?>

  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Items</h4>
            <p>Things you can do.</p>
            <ul class="list-group">
              <li class="list-group-item">Add Items</li>
              <li class="list-group-item">Update Items</li>
              <li class="list-group-item">Remove Items</li>
            </ul>
            <a href="items.php" class="btn btn-primary btn-block mt-3">Go to Items</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Deliver</h4>
            <p>Things you can do.</p>
            <ul class="list-group">
              <li class="list-group-item">Deliver items.</li>
              <li class="list-group-item">-</li>
              <li class="list-group-item">-</li>
            </ul>
            <a href="deliver.php" class="btn btn-primary btn-block mt-3">Go to Deliver</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Reports</h4>
            <p>Things you can do.</p>
            <ul class="list-group">
              <li class="list-group-item">Search log.</li>
              <li class="list-group-item">Get reports.</li>
              <li class="list-group-item">Download PDF.</li>
            </ul>
            <a href="reports.php" class="btn btn-primary btn-block mt-3">Go to Reports</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="./res/js/jquery-3.3.1.min.js" charset="utf-8"></script>
  <script src="./res/js/bootstrap.min.js" charset="utf-8"></script>
</body>
</html>
