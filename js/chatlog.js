$(document).ready(function(){ 

$("#uiSendmsg").click(function(){	
    var clientmsg = $("uiMsg").val();
    $.post("chatlog.php", {text: clientmsg});				
    $("uiMsg").attr("value", "");
    return false;
});

$("#uiSendto").click(function(){
    var sendto = $("#uiSendto").val();
    $.post("userslist.php", {text: sendto});
    alert(sendto);

});


document.getElementById("showHistory").innerHTML = "<h6>Chat History:</h6>";

var xmlhttp = new XMLHttpRequest();
var x ="";
var deleteButton = ""
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

        //***you can edit the design of chat history here***
        var myObj = JSON.parse(this.responseText);
        for (i = 0; i < myObj.length; i++) {

            //deleteButton = "<input type='submit' name='mDelete' value='"+myObj[i].id+"'/>";
            //x += deleteButton;
            x += "<span name='mID' value='"+myObj[i].id+"'>"+myObj[i].from + ": " + myObj[i].text + " (" + myObj[i].date + ")</span></br>";
            
          }

        document.getElementById("showHistory").innerHTML = x;
        

     }
};
xmlhttp.open("GET", "getChathistory.php", true);
xmlhttp.send();

});