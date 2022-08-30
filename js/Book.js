function CancelBook(name){
    order = name.split("_")[0];
    room = name.split("_")[1];
    date = name.split("_")[2];
    $.ajax({
        type: "POST",
        url: "php/dbActions.php",
        data: {validate: 'CancelBook', Order: order, Room: room, Date: date},
        cache: false,
        success: function(data) {
            location.reload();
      }
    });
}

function checkBookValidity(){
    var element = document.getElementsByClassName("CancelButton");
    for(i = 0 ; i<element.length; i++){
        var date = element[i].name.split("_")[2].split(":")[0];
        var day = date.split("/")[0];
        var month = date.split("/")[1];
        var year = date.split("/")[2];

        var dateObj = new Date();
        var currentMonth = dateObj.getUTCMonth() + 1; //months from 1-12
        var currentDay = dateObj.getUTCDate();
        var currentYear = dateObj.getUTCFullYear();
        
        var cancel = false;

        if(currentYear > year){
            cancel = true;
            console.log('1');
        }
        if(currentMonth > month && currentYear > year){
            cancel = true;
            console.log('2');
        }

        if(currentDay > day && currentMonth > month && currentYear > year){
            cancel = true;
            console.log('3');
        }
        
        if(cancel == true){
            CancelBook(element[i].name);
            cancel = false;
        }
    }
}