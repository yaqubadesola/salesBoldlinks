
function val() {
    
   var x = document.forms["dform"]["myInput"].value;
   
   if(x == "") {
        alert("Enter your todo and press enter");
        document.forms["dform"]["myInput"].focus();
        return false;
    }
    
    return true;
    
}

function todol() {
    
    if (val() == true) {
        
        
    
        URL="?myInput="+document.forms["dform"]["myInput"].value+"&tod="+document.forms["dform"]["tod"].value;
        
        }

    if (window.XMLHttpRequest) {
        
        xmlhttp=new XMLHttpRequest();
        
        }   else {
            
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            
            }
            
    xmlhttp.onreadystatechange=function() {
   
        
        if (xmlhttp.readyState==4 && xmlhttp.status==200){	
            //var resArr = json.parse(XMLHttp.responseText);
           var resArr = xmlhttp.responseText;
    	  
            document.getElementById("read").innerHTML=resArr;
           
        }
    }
    
    xmlhttp.open("POST","http://sales.boldlinks.com.ng/todoing.php"+URL,true);
    xmlhttp.send();

}