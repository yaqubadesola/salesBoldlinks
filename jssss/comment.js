
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
    
        URL="?id="+document.forms["commentor"]["id"].value+"&comment="+document.forms["commentor"]["comment"].value+"&comm="+document.forms["commentor"]["comm"].value;
        
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
    
    xmlhttp.open("POST","http://sales.boldlinks.com.ng/each_commenting.php"+URL,true);
    xmlhttp.send();

}