$(document).ready(function () {
  
  // window.load(function(){
    $val = $("#album option:first").val();
    $.post('link_list_images.php', {
      album_id1: $val,
    }, function (data) {
      console.log(data);
    });

  // });

  $('.title').on('click', function () {
    $('#access').text($(this).text());
  });

  
  $('.title').on('mouseover', function () {
    $('.title').css('background-color', 'white');
    $('.title').css('color', 'black');
    $(this).css('background-color', 'black');
    $(this).css('color', 'white');
  });


  $('#album').on('change', function(){
    $val = $("#album option:selected").val();
    $.post('link_list_images.php', {
      album_id1: $val,
    }, function (data) {
      console.log(data);

    })

    $('#images').text($val);
  });
});