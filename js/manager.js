
//manager
function getSelectionById(selection){
  var e = document.getElementById(selection);  
  var selected_value = e.options[e.selectedIndex].value;
  //console.log(selected_value);
  return selected_value;
}
var numRoom = getSelectionById("selectNumRoom");
function NumRooms(rooms){
  $.ajax({
    type: "POST",
    url: "php/manage.php",
    data: {validate: 'NumRoom', numRoom: rooms},
    cache: false,
    success: function(data) {
      document.getElementById('numRoomSent').innerHTML = data;
  }
});
return false;
}

$('#selectNumRoom').on('change', function(){
  var selected_value = getSelectionById("selectNumRoom")
  NumRooms(selected_value);
});


//manager