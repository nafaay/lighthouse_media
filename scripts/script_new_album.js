$(document).ready(function () {
  
  let shared = 'N';
  $('#private').on('click', function () {
    $('#access').text('Private');
  })

  $('#public').on('click', function () {
    $('#access').text('Public');
  })
  
  $('#private').on('mouseover', function () {
    $('#private').css('background-color', 'black');
    $('#private').css('color', 'white');
    $('#public').css('background-color', 'white');
    $('#public').css('color', 'black');
  })

  $('#public').on('mouseover', function () {
    $('#public').css('background-color', 'black');
    $('#public').css('color', 'white');
    $('#private').css('background-color', 'white');
    $('#private').css('color', 'black');
  })

  $('#submit').on('click', function () {
    verifyZones();

  })


  function verifyZones() {
    $pass = true;
    $('#titleMessage').text('');
    $('#descriptionMessage').text('');
    if ($.trim($('#title').val()) == '') {
      $pass = false;
      $('#titleMessage').css("color", "red");
      $('#titleMessage').css("fontWeight", "bold");
      $('#titleMessage').text('The Title is required');
    }
    if ($pass == true) {

      title = $.trim($('#title').val());
      if($('#access').text() == 'Private'){
        shared = 'N';        
      }
      else{
        if ($('#access').text() == 'Public'){
          shared = 'O';
        }
      }
      description = $.trim($('#description').val());
      $.post('link_new_album.php',
        {
          title1: title,
          shared1: shared,
          description1: description
        },
        function (data) {

          if ($.trim(data) == 'Done') {
            $('#titleMessage').text("Album Created");
          }
          console.log(data);
        });
    }
  }

});