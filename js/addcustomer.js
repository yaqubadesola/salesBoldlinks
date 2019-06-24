function addCustomer() {
    
    if(1 == 1) {
        URL="?name="+document.forms["customer"]["name"].value+"&phone="+document.forms["customer"]["phone"].value+"&email="+document.forms["customer"]["email"].value+"&address="+document.forms["customer"]["address"].value+"&save="+document.forms["customer"]["save"].value;

   
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
    
    xmlhttp.open("POST","http://sales.boldlinks.com.ng/addcustomer.php"+URL,true);
    xmlhttp.send();

}