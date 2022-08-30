numberRoom = 0;
choosenRoom = "";
choosenHotel = "";
Order = null;
DateBook = null;
switchFirst = false;
switchSecond = false;
reset = false;
Sreset = false;
validBook = false;
trigger = false;

const nextYear = new Date().getFullYear() + 1;
const fCalender = new CalendarPicker('#firstCalendar', {
  showShortWeekdays: true,
  min: new Date(),
  max: new Date(nextYear, 10) 
});



const sCalender = new CalendarPicker('#secondCalendar', {
  showShortWeekdays: true,
  min: new Date(),
  max: new Date(nextYear, 10) 
});

var newDate = fCalender.value
var oldDate = fCalender.value

var snewDate = sCalender.value
var soldDate = sCalender.value

var newMonth = getActualMonth(1);
var oldMonth = getActualMonth(1);

var snewMonth = getActualMonth(2);
var soldMonth = getActualMonth(2);

execute1();
async function execute1() {
  while (true) {
    await new Promise(resolve => setTimeout(resolve, 500));
    checkBook();
    var newDate = fCalender.value
    var snewDate = sCalender.value
    var newMonth = getActualMonth(1);
    var snewMonth = getActualMonth(2);
    if(newDate != oldDate ){
      validBook = false;
      oldDate = newDate;
      resetSecondCalendar();
      getDateBook();
      secondCalendarManage();
      trigger = true;
    }
    else if(snewDate != soldDate && trigger == true){
      validBook = true;
      soldDate = snewDate;
    }
    else if(newMonth != oldMonth ){
      switchFirst = true;
      oldMonth = newMonth;
      getDateBook();
    }
    else if(snewMonth != soldMonth || Sreset == true){
      switchSecond = true;
      soldMonth = snewMonth;
      secondCalendarManage();
      if(Sreset == true){
        Sreset = false;
      }
    }
  }
}

function checkBook(){
  if (validBook == false){
    var element = document.getElementsByName("bookRoom")[0];
    if(element.id == "bookRoom"){
      element.id = "bookRoomDisable";
      element.setAttribute('onclick','');
    }
  }
  else{
    var element = document.getElementsByName("bookRoom")[0];
    if(element.id == "bookRoomDisable" && choosenRoom != ""){
      element.id = "bookRoom";
      element.setAttribute('onclick','clickBook()');
    }
  }
}


function secondCalendarManage(){
  secondElement = document.getElementById("secondCalendar");
  secondMonthString = secondElement.children[1].children[0].children[0].innerHTML.split(" - ")[0];
  secondYearString = secondElement.children[1].children[0].children[0].innerHTML.split(" - ")[1];

  daysInMonth = new Date(parseInt(secondYearString), getMonthFromString(secondMonthString), 0).getDate();
  actualMonth = getMonthFromString(secondMonthString);
  //
  
  if(switchSecond == false){    
    secondElementTime = secondElement.children[1].children[1].children[1].children;
  }
  else{
    secondElementTime = secondElement.children[1].children[1].children[2].children;
  }

  var tempArray = new Array();
  for(i = 0; i<eval(DateBook).length; i++){
    var actualDate = JSON.stringify(eval(DateBook)[i]).split(":");
    var actualDateMonth1 = parseInt(actualDate[1].split("/")[1]);
    var actualDateDay1 = parseInt(actualDate[1].split("/")[0].substring(1));

    var actualDateMonth2 = parseInt(actualDate[2].split("/")[1]);
    var actualDateDay2 = parseInt(actualDate[2].split("/")[0]);

    if(actualDateMonth1 == getActualMonth(2)){
      if(actualDateMonth1 == actualDateMonth2){
        var numberLeft = (actualDateDay2 - actualDateDay1)+1;
        for(j = 0; j< numberLeft; j++){
          tempArray.push(actualDateDay1+j);
        }
      }
      else if(actualDateMonth1 < actualDateMonth2){
        var numberLeft = (daysInMonth - actualDateDay1)+1;
        for(j = 0; j< numberLeft; j++){
          tempArray.push(actualDateDay1+j);
        }
      }
    }
    else if(actualDateMonth1 < getActualMonth(2)){
      if(actualDateMonth2 ==  getActualMonth(2)){
        var numberLeft = daysInMonth - ((daysInMonth - actualDateDay1)+1);
        for(j = 0; j< numberLeft; j++){
          tempArray.push(actualDateDay1+j);
        }
      }
      else if(actualDateMonth2 >  getActualMonth(2)){
        var numberLeft = daysInMonth;
        for(j = 0; j< numberLeft; j++){
          tempArray.push(actualDateDay1+j);
        }
      }

    }
    clickMonth = fCalender.value.toString().split(" ")[1];
    clickDay = fCalender.value.toString().split(" ")[2];
    clickYear = fCalender.value.toString().split(" ")[3];
    if(tempArray.length > 0){
      if(getMonthFromString(clickMonth) > getActualMonth(2)){
        for(j = 0 ;  j<secondElementTime.length; j++){
          if(!isNaN(parseInt(secondElementTime[j].innerHTML))){
            secondElementTime[j].classList.add("disabled");
          }
        }
      }
      else if(getMonthFromString(clickMonth) < getActualMonth(2)){
        var disable = false;
        for(j = 0 ;  j<secondElementTime.length; j++){
          if(tempArray.includes(parseInt(secondElementTime[j].innerHTML))){
            disable = true;
          }
          if(disable == true){
            secondElementTime[j].classList.add("disabled");
          }
        }
      }
      else if(getMonthFromString(clickMonth) == getActualMonth(2)){
        var tempSwitch = false;
        for(j = 0 ;  j<secondElementTime.length; j++){
          if(tempSwitch == false){           
            if(parseInt(secondElementTime[j].innerHTML) != parseInt(clickDay)){
              secondElementTime[j].classList.add("disabled");
            }
            else{
              tempSwitch = true;
            }
          }
          else{
            if(tempArray.includes(parseInt(secondElementTime[j].innerHTML))){
              tempSwitch = false;
              secondElementTime[j].classList.add("disabled");
            }
          }
        }
      }
    }
  }
}

function getActualMonth(number){
  if(number == 1){
    firstElement = document.getElementById("firstCalendar");
  }
  else if(number == 2){
    firstElement = document.getElementById("secondCalendar");
  }
  firstMonthString = firstElement.children[1].children[0].children[0].innerHTML.split(" - ")[0];
  firstMonth = getMonthFromString(firstMonthString);
  return firstMonth;
}

function dateManage(dateBook){
  for(i = 0; i<dateBook.length; i++){
    var actualDate = dateBook[i].Date.split(":");
    var result = disableDateFirst(actualDate);
    if(result[3] == true){
      for(ii= 0; ii<result[1].length; ii++){
        if(parseInt(result[1][ii].innerHTML) == result[2]){
          for(j=0; j<result[0];j++){
            result[1][ii+j].classList.add("disabled");
          }
        }
      }
    }

  }
}

function resetSecondCalendar(){
  secondElement = document.getElementById("secondCalendar");
  if(switchSecond == false){    
    secondButtonNext = secondElement.children[1].children[1].children[2].children[1];
    secondButtonPrev = secondElement.children[1].children[1].children[2].children[0];
  }
  else{
    secondButtonNext = secondElement.children[1].children[1].children[1].children[1];
    secondButtonPrev = secondElement.children[1].children[1].children[1].children[0];
  }
  secondButtonNext.click();
  secondButtonPrev.click();
  switchSecond = true;
  Sreset = true;
}

function resetCalendar(){
  firstElement = document.getElementById("firstCalendar");
  if(switchFirst == false){    
    firstButtonNext = firstElement.children[1].children[1].children[2].children[1];
    firstButtonPrev = firstElement.children[1].children[1].children[2].children[0];
  }
  else{
    firstButtonNext = firstElement.children[1].children[1].children[1].children[1];
    firstButtonPrev = firstElement.children[1].children[1].children[1].children[0];
  }
  reset = true;
  firstButtonNext.click();
  firstButtonPrev.click();
  switchFirst = true;
  reset = false;
}

function disableDateFirst(actualDate){
  firstElement = document.getElementById("firstCalendar");
  firstMonthString = firstElement.children[1].children[0].children[0].innerHTML.split(" - ")[0];
  fistYearString = firstElement.children[1].children[0].children[0].innerHTML.split(" - ")[1];

  daysInMonth = new Date(parseInt(fistYearString), getMonthFromString(firstMonthString), 0).getDate();
  
  if(switchFirst == false){    
    firstElementTime = firstElement.children[1].children[1].children[1].children;
  }
  else{
    firstElementTime = firstElement.children[1].children[1].children[2].children;
  }
  firstMonth = getMonthFromString(firstMonthString);
  actualDayFirst = parseInt(actualDate[0].split("/")[0]);
  actualMonthFirst = parseInt(actualDate[0].split("/")[1]);

  actualDaySecond = parseInt(actualDate[1].split("/")[0]);
  actualMonthSecond = parseInt(actualDate[1].split("/")[1]);
  var number = 0;
  if(firstMonth == actualMonthFirst){
    if(actualMonthFirst == actualMonthSecond){
      number = actualDaySecond - actualDayFirst;
      return new Array(number+1,firstElementTime,actualDayFirst,true);
    }
    else{
      number = daysInMonth - actualDayFirst;
      return new Array(number,firstElementTime,actualDayFirst,true);
    }
  }
  else{
    return new Array(number,firstElementTime,actualDayFirst,false);
  }


}
function getMonthFromString(mon){
  return new Date(Date.parse(mon +" 1, 2012")).getMonth()+1
}


function getDateBook(){
    $.ajax({
    type: "POST",
    url: "php/dbActions.php",
    data: {validate: 'getDateBook', order: Order, room: choosenRoom},
    cache: false,
    success: function(data) {
      DateBook = data;
      dateManage(JSON.parse(data));

  }
}); 
}

function getSelectionById(selection){
    var e = document.getElementById(selection);  
    var selected_value = e.options[e.selectedIndex].value;
    return selected_value;
}

function clickBook(){
  var fDate = convertDateToFormat(fCalender.value);
  var sDate = convertDateToFormat(sCalender.value);
  var bookDate = fDate+":"+sDate;
  $.ajax({
    type: "POST",
    url: "php/dbActions.php",
    data: {validate: 'bookRoom',Order: Order,Date: bookDate, Room: choosenRoom},
    cache: false,
    success: function(data) {
      var text = JSON.parse(data);
      

  }
}); 


  
}

function convertDateToFormat(date){
  var convert = date;
  var dd = String(convert.getDate()).padStart(2, '0');
  var mm = String(convert.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = convert.getFullYear();

  convert = dd + '/' + mm + '/' + yyyy;
  return convert;
}

function GFG_click(clicked) {
  validBook = false;
  element = document.getElementById(clicked);
  if(numberRoom >0){
    for(i =0 ; i<numberRoom; i++){
      temp = document.getElementById("room"+(i+1))
      temp.name = ""
    }
    element.name = "chooseClick"
    choosenRoom = element.id
    resetCalendar();
    resetSecondCalendar();
    getDateBook();
  }
} 

  $('#inputSelectHotel').on('change', function(){
    var selected_value = getSelectionById("inputSelectHotel")
    resetCalendar();
    validBook = false;
    if(selected_value ==  "Choose Hotel"){
      CreateRooms(0);
    }
    else{
      currentHotel(selected_value);
    }
  });
  

  function currentHotel(hotel){
    $.ajax({
      type: "POST",
      url: "php/manage.php",
      data: {validate: 'currHotelReservation', hotel: hotel},
      cache: false,
      success: function(data) {
        var text = JSON.parse(data);
        CreateRooms(text);
    }
  }); 
  }

  function CreateRooms(data){
    nbRooms = data.nbImg
    numberRoom = nbRooms
    Order = data.Order
    text ='';
    if(nbRooms > 0){
      for(i=0; i<nbRooms; i++){
        text += '<img onClick="GFG_click(this.id)" style="padding: 10px;" width="200" src="../assets/hotels/'+Order+'/room/room'+(i+1)+'.png" name="" class="img-fluid" id="room'+(i+1)+'">';
      }
    }
    document.getElementById('roomChoose').innerHTML= text;
  }

 
  