<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy System : Log in</title>
  <link rel="stylesheet" href="./res/css/bootstrap.min.css">
</head>
<body class="bg-dark">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center text-white mb-4">Easy System</h2>
        <div class="row">
          <div class="col-md-6 mx-auto">

            <!-- form card login -->
            <div class="card rounded-0">
              <div class="card-header">
                <h3 class="mb-0">Login</h3>
              </div>
              <div class="card-body">
                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                  <div class="form-group">
                    <label for="uname1">Username</label>
                    <input type="text" class="form-control form-control-lg rounded-0" value="ShaNiraj" name="uname" id="uname1" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control form-control-lg rounded-0" id="pwd" name="pwd" required>
                  </div>
                  <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                </form>
              </div>
              <!--/card-block-->
            </div>
            <!-- /form card login -->

          </div>

        </div>
        <!--/row-->
      </div>
      <!--/col-->
    </div>
    <!--/row-->
  </div>
  <!--/container-->

  <!-- scripts -->
  <script src="./res/js/jquery-3.3.1.min.js" charset="utf-8"></script>
  <script src="./res/js/bootstrap.min.js" charset="utf-8"></script>

  <script type="text/javascript">
  $(document).ready(function() {
    submit();
  } );

  function submit() {
    $("#formLogin").submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: './tasks/login.php',
        data: $('form').serialize(),
        dataType: "html",
        async: true,
        success: function(msg) {
          $("#deliverItemOutput").fadeIn();
          if (msg !== '1') {
            alert("Wrong Password!");
          } else {
            window.location='index.php';
          }
        }
      });
    });
  }

  </script>
</body>
</html>
