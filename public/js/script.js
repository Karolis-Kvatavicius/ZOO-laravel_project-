$(document).ready(function() {
  $('#selectSpecies').change(function() {
    var species_id = $(this).val();
    var token = $("input[name='_token']").val();
    $.ajax({
      type: "POST",
      url: "/getmsg/"+species_id,
      data: {species_id:species_id, _token:token},
      success: function (data) {
         console.log(data); 
        $("#selectManager").find('option').remove().end();
          for (var i = 0; i < data.managers.length; i++) {
            $("#selectManager").append(new Option(data.managers[i].name + ' ' + data.managers[i].surname, data.managers[i].id));
          }
      }
    });
  });

  $("i").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
});

