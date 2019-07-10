function validateForm() {
    
   var x = document.forms["loginForm"]["username"].value;
   
   if(x == "") {
        alert("Your Username can't be empty");
        document.forms["loginForm"]["username"].focus();
        return false;
    }
    
    var y  = document.forms["loginForm"]["password"].value;
    
    if(y == "") {
        
        alert("your Password can't be empty");
        document.forms["loginForm"]["password"].focus();
        return false;
    }
    //alert("i even reah here")
    return true;

  } 
  

        function check(){
            
            if(validateForm()== true) {
           // alert("i even reah here oooooo")
           // alert("Nonsense");
            URL="?username="+document.forms["loginForm"]["username"].value+"&password="+document.forms["loginForm"]["password"].value;
            var XMLHttp = new XMLHttpRequest();//XMLHttpRequest
            XMLHttp.onreadystatechange = function() {
                if (XMLHttp.readyState == 4 && this.status == 200) {
                    var resArr = JSON.parse(XMLHttp.responseText);
                    document.getElementById("try").innerHTML  = resArr[1];
                    document.getElementById("try2").innerHTML = resArr[0];
                    
                }
            }
            
            XMLHttp.open("POST", "http://localhost/salesBoldlinks/login.php"+URL, true);
            XMLHttp.send();
        }
   }
