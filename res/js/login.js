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
          alert("Wrong Username or Password!");
        } else {
          window.location='index.php';
        }
      }
    });
  });
}
