$(document).ready(function () {
  $('.title').on('click', function () {
    $('#access').text($(this).text());
  });

  
  $('.title').on('mouseover', function () {
    $('.title').css('background-color', 'white');
    $('.title').css('color', 'black');
    $(this).css('background-color', 'black');
    $(this).css('color', 'white');
  });

  $('#submit').on('click', function () {
    verifyZones();
  });


  function verifyZones() {
    $pass = true;
    $('#titleMessage').text('');
    $('#descriptionMessage').text('');
    $('#file_to_uploadMessage').text('');
    if ($.trim($('#title').val()) == '') {
      $pass = false;
      $('#titleMessage').css("color", "red");
      $('#titleMessage').css("fontWeight", "bold");
      $('#titleMessage').text('The Title is required');
    }
    if ($.trim($('#description').val()) == '') {
      $pass = false;
      $('#descriptionMessage').css("color", "red");
      $('#descriptionMessage').css("fontWeight", "bold");
      $('#descriptionMessage').text('Give some description');
    }

    file_to_upload = $.trim($('#file_to_upload').val());
    if (file_to_upload.trim() == "") {
      $pass = false;
      $('#file_to_uploadMessage').css("color", "red");
      $('#file_to_uploadMessage').css("fontWeight", "bold");
      $('#file_to_uploadMessage').text('You have to choose at least one image');

    }
    
    if($pass == true){
      album_id_title = $.trim($('#access').text());
      title = $.trim($('#title').val());
      description = $.trim($('#description').val());

      array_album_id = album_id_title.split(" ");
      album_id = array_album_id[2];
      album_title = array_album_id[4];
      array_images = [];
      let files = $('#file_to_upload')[0].files;
      filename = "";
      for(let i=0; i<files.length; i++){
        array_images.push(files[i].name);
        if(i == files.length-1){
          filename += files[i].name;
        }
        else{
          filename += files[i].name +",";
        }
      }
      $.post('link_upload_images.php', {
        album_id1 : album_id,
        array_images1: array_images,
        title1: title,
        description1: description,
        filename1: filename
      }, function(data){
        console.log(data);
        if(data == 'Done'){
          $('#titleMessage').css("color", "green");
          $('#titleMessage').css("fontWeight", "bold");
          $('#titleMessage').text('Images created and assigned to '+album_title);       
        }
      })
    }
  }
});