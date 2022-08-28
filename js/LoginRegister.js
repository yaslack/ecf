//Login/Register
function validateLogin(){
    var email = document.getElementById('emailogin').value;
    var password = document.getElementById('passwordlogin').value;
  
    var button = document.getElementById("submitLogin");
    $.ajax({
      type: "POST",
      url: "php/dbActions.php",
      data: {validate: 'CheckLogin', email: email, password: password},
      cache: false,
      success: function(data) {
        var form = $("#loginForm");
        if (form[0].checkValidity() === false) {
          form[0].reportValidity();
        }
        else{
  
          if (data == "Correct") {
            document.getElementById("submitLogin").onclick = true;
          }
          else{
            var mymodal = $('#Modal');
            if(data == "Email empty"){
              mymodal.find('.modal-body').text('Please fill the Email Input');
            }
            else if(data == "Password empty"){
              mymodal.find('.modal-body').text('Please fill the Password Input');
            }
            else if(data == "Incorrect Email!" || data == "Incorrect Password!"){
              mymodal.find('.modal-body').text('Your Login information are false');
            }
            mymodal.modal('show');
          }
        }
        
  
    }
  });
    return false;
  
  }
  function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
      end = new Date().getTime();
   }
  }
  
  function validateRegister(){
  
    var email = document.getElementById('emailregister').value;
  
    $.ajax({
      type: "POST",
      url: "php/dbActions.php",
      data: {validate: 'CheckRegister', email: email},
      cache: false,
      success: function(data) {
        var form = $("#registerForm");
        if (form[0].checkValidity() === false) {
          form[0].reportValidity();
        }
        else{
          if (data == "Correct") {
            document.getElementById("submitRegister").onclick = true;
          }
          else{
            //console.log(data);
            var mymodal = $('#Modal');
            if(data == "Empty"){
              mymodal.find('.modal-body').text('Please fill all the Inputs');
            }
            else if(data == "Exist"){
              mymodal.find('.modal-body').text('This email is already in use please chose another one');
            }
            mymodal.modal('show');
          }
        }
  
    }
  });
    return false;
  }
  //Login/Register