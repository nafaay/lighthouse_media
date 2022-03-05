$(document).ready(function () {

  let arrayEmailsToDefriend;
  let arrayEmailsToAccept;
  let arrayEmailsToRemove;
  let arrayEmailsToDeny;




  $('#defriend').on('click', function () {
    verifyZonesDefriend();
  });

  $('#accept').on('click', function () {
    verifyZonesAccept();
  });

  $('#deny').on('click', function () {
    verifyZonesDeny();
  });

  $('#remove').on('click', function () {
    verifyZonesRemove();
  });

  function verifyZonesDefriend(){
    arrayEmailsToDefriend = [];
    let boolDefriend = false;
    cpt = -1;
    $('#tableF').find('tr').each(function(){
      cpt++;
      let row = $(this);
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolDefriend = true;
        arrayEmailsToDefriend.push($("#tdF" + cpt).text());
      }
    })
    if (boolDefriend) {
      if (confirm("Are you sure you want to Defriend selection?")) {
        defriendFriends(arrayEmailsToDefriend);
        location.replace('list_friends.php');
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
      }
      else {
        return;
      }
    }
  }

  function defriendFriends(arrayToDefriend){
    arrayToDefriend.forEach(element => {
      $.post('link_list_friends_defriend.php', {
        email_address1: element
      },
      function(data){
      });
    });
  }

  function verifyZonesAccept() {
    arrayEmailsToAccept = [];
    let boolAccept = false;
    cpt = -1;
    $('#tableR').find('tr').each(function () {
      cpt++;
      let row = $(this);
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolAccept = true;
        arrayEmailsToAccept.push($("#tdR" + cpt).text());
      }
    })
    if (boolAccept) {
      if (confirm("Are you sure you want to Accept selection?")) {
        acceptFriends(arrayEmailsToAccept);
        location.replace('list_friends.php');
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
      }
      else {
        return;
      }
    }
  }

  function acceptFriends(arrayToAccept) {
    arrayToAccept.forEach(element => {
      $.post('link_list_friends_accept.php', {
        email_address1: element
      },
        function (data) {
        });
    });
  }

  function verifyZonesRemove() {
    arrayEmailsToRemove = [];
    let boolRemove = false;
    cpt = -1;
    $('#tableS').find('tr').each(function () {
      cpt++;
      let row = $(this);
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolRemove = true;
        arrayEmailsToRemove.push($("#tdS" + cpt).text());
      }
    })
    if (boolRemove) {
      if (confirm("Are you sure you want to Remove selection?")) {
        removeFriends(arrayEmailsToRemove);
        location.replace('list_friends.php');
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
      }
      else {
        return;
      }
    }
  }

  function removeFriends(arrayToRemove) {
    arrayToRemove.forEach(element => {
      $.post('link_list_friends_remove.php', {
        email_address1: element
      },
        function (data) {
        });
    });
  }


  // function verifyZonesDeny() {
  //   cpt = -1;
  //   $('#tableR').find('tr').each(function () {
  //     cpt++;
  //     let row = $(this);
  //     boolDeny = false;
  //     if (row.find('input[type="checkbox"]').is(':checked')) {
  //       boolDeny = true;
  //       console.log("chR" + cpt + " " + $("#chR" + cpt).prop("checked"));
  //       console.log("is checked in Deny");
  //       console.log("tdR" + cpt + " " + $("#tdR" + cpt).text());

  //     }
  //   })
  //   if (boolDeny) {
  //     if (confirm("Are you sure you want to Deny selection?")) {
  //       //defriendFriends();
  //       //verify();
  //       $('#msg').css("color", "green");
  //       $('#msg').css("fontWeight", "bold");
  //       // $('#msg').text("Friendship removed");
  //     }
  //     else {
  //       return;
  //     }
  //   }
  // }

////////////////////////////////////////////////

  function verifyZonesDeny() {
    arrayEmailsToDeny = [];
    let boolDeny = false;
    cpt = -1;
    $('#tableR').find('tr').each(function () {
      cpt++;
      let row = $(this);
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolDeny = true;
        arrayEmailsToDeny.push($("#tdR" + cpt).text());
      }
    })
    if (boolDeny) {
      if (confirm("Are you sure you want to Deny selection?")) {
        denyFriends(arrayEmailsToDeny);
        location.replace('list_friends.php');
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
      }
      else {
        return;
      }
    }
  }

  function denyFriends(arrayToDeny) {
    arrayToDeny.forEach(element => {
      $.post('link_list_friends_deny.php', {
        email_address1: element
      },
        function (data) {
        });
    });
  }
});