$(document).ready(function () {

  // window.load(function(){
  $val = $("#album option:first").val();
  $.post('link_list_images.php', {
    album_id1: $val,
  }, function (data) {
    // console.log(data);
  });


  $('.title').on('click', function () {
    $('#access').text($(this).text());
  });


  $('.title').on('mouseover', function () {
    $('.title').css('background-color', 'white');
    $('.title').css('color', 'black');
    $(this).css('background-color', 'black');
    $(this).css('color', 'white');
  });


  $('#album').on('change', function () {
    $array_images = [];
    $val = $("#album option:selected").val();
    $.post('link_list_images.php', {
      album_id1: $val,
    }, function (data) {
      console.log(data);
      // if (data.length > 2) {
      //   $array_images = data.split(',');
      //   // $array_images.forEach(element => {
      //   // });
      // }
      // // console.log("/images/albums/" + $array_images[0]);
      // // $('#images').append($('<img>', {
      // //   // id: 'theImg', src: "/images/albums/Canada02.jpg" + $array_images[0]
      // //   id: 'theImg', src: "../images/albums/$array_images[0]"
      // // }))
      // $("#images").attr('src', "../images/albums/" + $array_images[0]);
    })

  });
});