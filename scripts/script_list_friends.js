$(document).ready(function () {

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
    cpt = -1;
    $('#tableF').find('tr').each(function(){
      cpt++;
      let row = $(this);
      boolDefriend = false;
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolDefriend = true;
        console.log("chF"+cpt +" "+ $("#chF" + cpt).prop("checked"));
        console.log("tdF" + cpt + " " + $("#tdF" + cpt).text());

        console.log("is checked in Defriend");
      }
    })
    if (boolDefriend) {
      if (confirm("Are you sure you want to Defriend selection?")) {
        //defriendFriends();
        //verify();
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
        // $('#msg').text("Friendship removed");
      }
      else {
        return;
      }
    }
  }

  function verifyZonesAccept() {
    cpt = -1;
    $('#tableR').find('tr').each(function () {
      cpt++;
      let row = $(this);
      boolAccept = false;
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolAccept = true;
        console.log("chR" + cpt + " " + $("#chR" + cpt).prop("checked"));
        console.log("is checked in Accept");
        console.log("tdR" + cpt + " " + $("#tdR" + cpt).text());
      }
    })
    if (boolAccept) {
      if (confirm("Are you sure you want to Accept selection?")) {
        //defriendFriends();
        //verify();
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
        // $('#msg').text("Friendship removed");
      }
      else {
        return;
      }
    }
  }

  function verifyZonesDeny() {
    cpt = -1;
    $('#tableR').find('tr').each(function () {
      cpt++;
      let row = $(this);
      boolDeny = false;
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolDeny = true;
        console.log("chR" + cpt + " " + $("#chR" + cpt).prop("checked"));
        console.log("is checked in Deny");
        console.log("tdR" + cpt + " " + $("#tdR" + cpt).text());

      }
    })
    if (boolDeny) {
      if (confirm("Are you sure you want to Deny selection?")) {
        //defriendFriends();
        //verify();
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
        // $('#msg').text("Friendship removed");
      }
      else {
        return;
      }
    }
  }
  function verifyZonesRemove() {
    cpt = -1;
    let boolRemove = false;
    $('#tableS').find('tr').each(function () {
      cpt++;
      let row = $(this);
      if (row.find('input[type="checkbox"]').is(':checked')) {
        boolRemove = true;
        console.log("chS" + cpt + " " + $("#chS" + cpt).prop("checked"));
        console.log("is checked in Remove");
        console.log("tdS" + cpt + " " + $("#tdS" + cpt).text());

      }
    })
    if (boolRemove) {
      if (confirm("Are you sure you want to Remove selection?")) {
        //defriendFriends();
        //verify();
        $('#msg').css("color", "green");
        $('#msg').css("fontWeight", "bold");
        // $('#msg').text("Friendship removed");
      }
      else {
        return;
      }
    }
  }

});