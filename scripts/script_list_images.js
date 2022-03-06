$(document).ready(function () {
  
  $('.title').on('click', function () {
    $('#access').text($(this).text());
  })

  
  $('.title').on('mouseover', function () {
    $('.title').css('background-color', 'white');
    $('.title').css('color', 'black');
    $(this).css('background-color', 'black');
    $(this).css('color', 'white');
  })




});