
function val() {
    
   var x = document.forms["commentor"]["comment"].value;
   
   if(x == "") {
        alert("Write a comment");
        document.forms["commentor"]["comment"].focus();
        return false;
    }
    
    return true;
    
}

function commenting() {
    
    if (val() == true) {
    
        URL="?comment="+document.forms["commentor"]["comment"].value+"&comm="+document.forms["commentor"]["comm"].value;
        alert(URL);
        }

    if (window.XMLHttpRequest) {
        
        xmlhttp=new XMLHttpRequest();
        
        }   else {
            
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            
            }
            
    xmlhttp.onreadystatechange=function() {
   
        
        if (xmlhttp.readyState==4 && xmlhttp.status==200){	
    	   document.getElementById("read").innerHTML=xmlhttp.responseText;
        }
    }
    
    xmlhttp.open("POST","http://sales.boldlinks.com.ng/commenting.php"+URL,true);
    xmlhttp.send();

}