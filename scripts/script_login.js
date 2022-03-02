$(document).ready(function () {
  $('#submit').on('click', function () {
    verifyZones();
  });

  function verifyZones() {
    $pass = true;
    $('#email_address_message').text('');
    $('#password_message').text('');
    if ($.trim($('#email_address').val()) == '') {
      $pass = false;
      $('#email_address_message').css("color", "red");
      $('#email_address_message').css("fontWeight", "bold");
      $('#email_address_message').text('The Email Address is required');
    }

    if ($.trim($('#password').val()) == '') {
      $pass = false;
      $('#password_message').css("color", "red");
      $('#password_message').css("fontWeight", "bold");
      $('#password_message').text('The password is required');
    }


    if ($pass == true) {
      email_address = $.trim($('#email_address').val());
      password = $.trim($('#password').val());
      $.post('link_login.php',
        {
          email_address1: email_address,
          password1: password,
        },
        function (data) {
          if ($.trim(data) == 'NotFound') {
            $('#email_address_message').css("color", "red");
            $('#email_address_message').css("fontWeight", "bold");
            $('#email_address_message').text('No user with this Email Address And/Or Password exists');
          }
          else {
            if ($.trim(data) == 'Found') {
              location.href = "next.php";
            }
            else {
              $('#email_address_message').text(data);
            }
          }

        });
    }
  }
});