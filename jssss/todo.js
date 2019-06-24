
function val() {
    
   var x = document.forms["todoer"]["todoing"].value;
   
   if(x == "") {
        alert("Enter your todo and press enter");
        document.forms["todoer"]["todoing"].focus();
        return false;
    }
    
    return true;
    
}

function todol() {
    
    if (val() == true) {
        
        
    
        URL="?todoing="+document.forms["todoer"]["todoing"].value+"&tod="+document.forms["todoer"]["tod"].value;
        
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
    
    xmlhttp.open("POST","http://sales.boldlinks.com.ng/todoing.php"+URL,true);
    xmlhttp.send();

}