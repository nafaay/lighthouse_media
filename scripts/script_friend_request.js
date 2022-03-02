$(document).ready(function () {
  $('#submit').on('click', function () {
    verifyZones();
  });

  function validateemail($email_address) {
    let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!$email_address.match(mailformat))
      return false;
    return true;
  }


  function verifyZones() {
    $pass = true;
    $('#email_address_message').text('');
    $('#email_address_message2').text('');
    $('#email_address_message3').text('');
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

    if ($pass == true) {
      email_address = $.trim($('#email_address').val());
      password = $.trim($('#password').val());
      $.post('link_friend_request.php',
        {
          email_address1: email_address,
        },
        function (data) {
          if ($.trim(data) == 'NotFound') {
            $('#email_address_message').css("color", "red");
            $('#email_address_message').css("fontWeight", "bold");
            $('#email_address_message').text('No User with this Email Address exists');
          }
          else {
            if ($.trim(data) == 'FoundRequest') {
              $('#email_address_message').css("color", "red");
              $('#email_address_message').css("fontWeight", "bold");
              $('#email_address_message').text('This request already sent to this User');
            }
            else {
              if ($.trim(data) == 'Same') {
                $('#email_address_message').css("color", "red");
                $('#email_address_message').css("fontWeight", "bold");
                $('#email_address_message').text('You cannot send a request to yourself');
              }
              else {
                // if ($.trim(data) == 'Done') {
                $user = $.trim(data);
                $text = "Request sent to " +$user;
                $text2 = "Once " +$user +" will accept you request";
                $text3 = 'You will become friends';
                $('#email_address_message').css("color", "green");
                $('#email_address_message').css("fontWeight", "bold");
                $('#email_address_message2').css("color", "green");
                $('#email_address_message2').css("fontWeight", "bold");
                $('#email_address_message3').css("color", "green");
                $('#email_address_message3').css("fontWeight", "bold");
                $('#email_address_message').text($text);
                $('#email_address_message2').text($text2);
                $('#email_address_message3').text($text3);

                // }
              }
            }
          }

        });
    }
  }
});