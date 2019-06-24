/*$(document).ready(function(){
    $("#hide").click(function(){
        $("#show").slideToggle("fast")
    });
});*/





function myFunction() { 
    var checkBox = document.getElementById("show");
    var text = document.getElementById("hide");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }
}

function myFunctionb() {
    var checkBox = document.getElementById("see");
    var text = document.getElementById("blind");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }
}

function myFunctionc() {
    var checkBox = document.getElementById("watch");
    var text = document.getElementById("pretend");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }
}

/*function showClock() {
    
    var todayDate = new Date();
    var h = todayDate.getHours();
    var m = todayDate.getMinutes();
    var s = todayDate.getSeconds();
    var session = "AM";

   if (h == 0) {
    h = 12;
    }

    if(h > 12) 
    {
    h = h -12;
    session = "PM"
    }
    

    h = (h < 10)? "0" + h : h;
    m = (m < 10)? "0" + m : m;
    s = (s < 10)? "0" + s : s;
    
    
    var time = h + ":" + m + ":" + s + " " + session;
    
    document.getElementById('clock').innerHTML = time;
    setTimeout(showClock, 1000);
}

//setTimeout(showClock, 1000); 
showClock();*/


