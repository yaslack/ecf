
//admin
  function getSelectionById(selection){
      var e = document.getElementById(selection);  
      var selected_value = e.options[e.selectedIndex].value;
      return selected_value;
  }
    
  disableBtn();
  
  function disableBtn(){
    var selected_value = getSelectionById("inputSelect1")
    if(selected_value == "Choose..."){
      document.getElementById("AdminBtnUpdate").classList.add('disabled');
      document.getElementById("AdminBtnCreate").classList.add('disabled');
      document.getElementById("AdminBtnDelete").classList.add('disabled');
  
      document.getElementById('AdminInputEmail').removeAttribute('required');
      document.getElementById('AdminInputEmail').setAttribute('readonly', true);
    }
    else if(selected_value == "New +"){
      document.getElementById("AdminBtnUpdate").classList.add('disabled');
      document.getElementById("AdminBtnDelete").classList.add('disabled');
      document.getElementById("AdminBtnCreate").classList.remove('disabled');
      document.getElementById("AdminBtnCreate").classList.remove('disabled');
      document.getElementById("AdminInputHash").value ="Enter New Password";
  
      document.getElementById('AdminInputEmail').removeAttribute('readonly');
      document.getElementById('AdminInputEmail').setAttribute('required', true);
      
    }
    else{
      document.getElementById("AdminBtnUpdate").classList.remove('disabled');
      document.getElementById("AdminBtnDelete").classList.remove('disabled');
      document.getElementById("AdminBtnCreate").classList.add('disabled');
  
      document.getElementById('AdminInputEmail').removeAttribute('required');
      document.getElementById('AdminInputEmail').setAttribute('readonly', true);
    }
  }
  
  $('#inputSelect1').on('change', function(){
    var selected_value = getSelectionById("inputSelect1")
    if(selected_value ==  "Choose..." || selected_value == "New +" ){
      document.getElementById("AdminInputName").value = "";
      document.getElementById("AdminInputCity").value = "";
      document.getElementById("AdminInputAdress").value = "";
      document.getElementById("AdminInputDescription").value = "";
      document.getElementById("AdminInputLastName").value = "";
      document.getElementById("AdminInputFirstName").value = "";
      document.getElementById("AdminInputEmail").value = "";
      document.getElementById("AdminInputHash").value = "";
    }
    else{
      currentHotel(selected_value);
    }
    disableBtn()
  });
  
  function currentHotel(hotel){
    $.ajax({
      type: "POST",
      url: "php/manage.php",
      data: {validate: 'currHotel', hotel: hotel},
      cache: false,
      success: function(data) {
  
        var text = JSON.parse(data);
        document.getElementById("AdminInputOrder").value = text.Order; 
        document.getElementById("AdminInputName").value = text.Name;
        document.getElementById("AdminInputCity").value = text.City;
        document.getElementById("AdminInputAdress").value = text.Adress;
        document.getElementById("AdminInputDescription").value = text.Description;
        document.getElementById("AdminInputLastName").value = text.LastName;
        document.getElementById("AdminInputFirstName").value = text.FirstName;
        document.getElementById("AdminInputEmail").value = text.Email;
        document.getElementById("AdminInputHash").value = text.Hash;
        //console.log(text);
  
    }
  }); 
  }
  
  function UpdateInfo(){
    Order = document.getElementById("AdminInputOrder").value;
    Name = document.getElementById("AdminInputName").value;
    City = document.getElementById("AdminInputCity").value;
    Adress = document.getElementById("AdminInputAdress").value;
    Description = document.getElementById("AdminInputDescription").value;
    LastName = document.getElementById("AdminInputLastName").value;
    FirstName = document.getElementById("AdminInputFirstName").value;
    Email = document.getElementById("AdminInputEmail").value;
    Password = document.getElementById("AdminInputHash").value;
  
    $.ajax({
      type: "POST",
      url: "php/dbActions.php",
      data: {validate: 'UpdateInfo', Order: Order, Name: Name, City: City,
       Adress: Adress, Description: Description, LastName: LastName,
       FirstName: FirstName, Email: Email, Password: Password},
      cache: false,
      success: function(data) {
        var form = $("#AdminForm");
        if (form[0].checkValidity() === false) {
          form[0].reportValidity();
        }
        else{
          if (data == "Correct") {
            
            var mymodal = $('#AdminModal');
            mymodal.find('.modal-body').text('Updated Successfully');
            mymodal.modal('show');
          }
        }
        
  
    }
  });
  }
  function DeleteInfo(){
    Order = document.getElementById("AdminInputOrder").value;
    Email = document.getElementById("AdminInputEmail").value;
  
    $.ajax({
      type: "POST",
      url: "php/dbActions.php",
      data: {validate: 'DeleteInfo', Order: Order, Email: Email},
      cache: false,
      success: function(data) {
        console.log(data);
        var form = $("#AdminForm");
        if (data == "Correct") {
          
          var mymodal = $('#AdminModal');
          mymodal.find('.modal-body').text('Deleted Successfully');
          mymodal.modal('show');
        }
    }
  });
  }
  function CreateInfo(){
    Name = document.getElementById("AdminInputName").value;
    City = document.getElementById("AdminInputCity").value;
    Adress = document.getElementById("AdminInputAdress").value;
    Description = document.getElementById("AdminInputDescription").value;
    LastName = document.getElementById("AdminInputLastName").value;
    FirstName = document.getElementById("AdminInputFirstName").value;
    Email = document.getElementById("AdminInputEmail").value;
    Password = document.getElementById("AdminInputHash").value;
  
    $.ajax({
      type: "POST",
      url: "php/dbActions.php",
      data: {validate: 'CreateInfo', Name: Name, City: City,
       Adress: Adress, Description: Description, LastName: LastName,
       FirstName: FirstName, Email: Email, Password: Password},
      cache: false,
      success: function(data) {
        //console.log(data);
        var form = $("#AdminForm");
        if (form[0].checkValidity() === false) {
          form[0].reportValidity();
        }
        else{
          if (data == "CorrectCorrect") {
            var mymodal = $('#AdminModal');
            mymodal.find('.modal-body').text('Created Successfully');
            mymodal.modal('show');
          }
          else{
            var mymodal = $('#AdminModal');
            mymodal.find('.modal-body').text('This Email is already used. Please choose another one');
            mymodal.modal('show');
          }
        }
        
  
    }
  });
  }
  
  //admin
  