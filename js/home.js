roomIndex(1);
const interval = setInterval(function() {
    //console.log($('div.active').html())
}, 1000);

$('#mycarousel').on('slide.bs.carousel', function() {
    actual();
    
});
async function actual() {
    await new Promise(resolve => setTimeout(resolve, 1000));
    img = $('div.active').html();
    img = img.substring(
        img.indexOf('hotels/') + 7, 
        img.lastIndexOf('/facade/')
    );
    roomIndex(parseInt(img));
    
  }

function roomIndex(num){
$.ajax({
    type: "POST",
    url: "pages/php/manage.php",
    data: {validate: 'roomIndex', numActualRoom: num},
    cache: false,
    success: function(result){
        $("#room").html(result);
    }
});
}
