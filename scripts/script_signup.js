$(document).ready(function () {

  clearMessages();
  $('#user_name').on('focus', function () {
    $('#user_name_message').text('');
  })
  $('#submit').on('click', function () {
    verifyZones();
  });

  function clearMessages() {
    $('#user_name_message').text('');
    $('#email_address_message').text('');
    $('#password_message').text('');
    $('#password_again_message').text('');
  }

  function validpasswordLen($password) {
    if ($password.length < 6) {
      return false;
    }
  }

  function validpasswordUpper($password) {
    let upperCase = new RegExp('[^A-Z]');
    if (!$password.match(upperCase))
      return false;
    return true;
  }

  function validateemail($email_address) {
    let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!$email_address.match(mailformat))
      return false;
    return true;
  }

  function validpasswordLower($password) {
    let lowerCase = new RegExp('[^a-z]');
    if (!$password.match(lowerCase))
      return false;
    return true;
  }

  function validpasswordDigit($password) {
    let numbers = new RegExp('[0-9]');
    if (!$password.match(numbers))
      return false;
    return true;
  }

  function validpassword_again($password) {
    if ($password != $.trim($('#password').val()))
      return false;
    return true;
  }


  function verifyZones() {
    $pass = true;
    clearMessages();
    if ($.trim($('#user_name').val()) == '') {
      $pass = false;
      $('#user_name_message').css("color", "red");
      $('#user_name_message').css("fontWeight", "bold");
      $('#user_name_message').text('The User Name is required');
    }

    if ($.trim($('#email_address').val()) == '') {
      $pass = false;
      $('#email_address_message').css("color", "red");
      $('#email_address_message').css("fontWeight", "bold");
      $('#email_address_message').text('The Email Address is required');
    }
    else {
      $email_address = $.trim($('#email_address').val());
      $message1 = validateemail($email_address);
      if ($message1 == false) {
        $pass = false;
        $('#email_address_message').css("color", "red");
        $('#email_address_message').css("fontWeight", "bold");
        $('#email_address_message').text('The Email Address is not valid');
      }
      else {
        $pass = true;
        $('#email_address_message').text('');
      }
    }

    if ($.trim($('#password').val()) == '') {
      $pass = false;
      $('#password_message').css("color", "red");
      $('#password_message').css("fontWeight", "bold");
      $('#password_message').text('The password is required');
    }
    else {
      $password = $.trim($('#password').val());
      $message1 = validpasswordLen($password);
      if ($message1 == false) {
        $pass = false;
        $('#password_message').css("color", "red");
        $('#password_message').css("fontWeight", "bold");
        $('#password_message').text('Password must be at least 6 characters');
      }
      else {
        $message1 = validpasswordUpper($password);
        if ($message1 == false) {
          $pass = false;
          $('#password_message').css("color", "red");
          $('#password_message').css("fontWeight", "bold");
          $('#password_message').text('Password must Contain at least one Upper case');
        }
        else {
          $message1 = validpasswordLower($password);
          if ($message1 == false) {
            $pass = false;
            $('#password_message').css("color", "red");
            $('#password_message').css("fontWeight", "bold");
            $('#password_message').text('Password must Contain at least one lower case');
          }
          else {
            $message1 = validpasswordDigit($password);
            if ($message1 == false) {
              $pass = false;
              $('#password_message').css("color", "red");
              $('#password_message').css("fontWeight", "bold");
              $('#password_message').text('Password must Contain at least one digit');
            }
          }
        }
      }
    }
    if ($.trim($('#password_again').val()) == '') {
      $pass = false;
      $('#password_again_message').css("color", "red");
      $('#password_again_message').css("fontWeight", "bold");
      $('#password_again_message').text('The password is required');
    }
    else {
      $password_again = $.trim($('#password_again').val());
      $message1 = validpassword_again($password_again);
      if ($message1 == false) {
        $pass = false;
        $('#password_again_message').css("color", "red");
        $('#password_again_message').css("fontWeight", "bold");
        $('#password_again_message').text('passwords do not match ');
      }
    }

    if ($pass == true) {
      $user_name = $.trim($('#user_name').val());
      $email_address = $.trim($('#email_address').val());
      $password = $.trim($('#password').val());
      $password_again = $.trim($('#password_again').val());

      $.post('link_signup.php',
        {
          $user_name1: $user_name,
          $email_address1: $email_address,
          $password1: $password,
          $password_again1: $password_again
        },
        function (data) {
          if ($.trim(data) == 'Created') {
            $('#user_name_message').css("color", "red");
            $('#user_name_message').css("fontWeight", "bold");
            $('#user_name_message').text('user with this email already exists');
          }
          else {
            if ($.trim(data) == 'Done') {
              $('#user_name_message').css("color", "green");
              $('#user_name_message').css("fontWeight", "bold");
              $('#user_name_message').text('User created');
            }
            else {
              $('#user_name_message').text(data);
            }
          }

        });
    }
  }
});