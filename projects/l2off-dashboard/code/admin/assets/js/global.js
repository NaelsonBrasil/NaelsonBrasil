$(function() {
  
  $("#registerForm").click(function(e) {
    if ($("#terms").is(":checked")) {
      e.preventDefault();
      $.ajax({
        url: "http://localhost/admin/run.php",
        type: "POST",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
          user: $("#user").val(),
          email: $("#email").val(),
          password: $("#password").val()
        }),
        dataType: "json",
        success: function(json) {
          if (json.alertSuccess === true) alert("Register Successful!");

          if (json.alertName === true) alert("Account name already exist!");

          if (json.alertEmail === true) alert("Email already exist!");

          if (json.alertEmpty === true) alert("Empty!");
        },
        error: function() {
          console.log("Error Ajax");
        }
      });
    } else {
      alert("Aceite os termos!");
    }
  });
});
