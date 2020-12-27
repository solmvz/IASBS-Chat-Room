$(document).ready(function() 
{ 
    $("#uiSendmsg").click(function()
    {	
        var clientmsg = $("uiMsg").val();
        $.post("chatlog.php", {text: clientmsg});				
        $("uiMsg").attr("value", "");
        return false;
    });

    $("#uiSendto").click(function()
    {
        var sendto = $("#uiSendto").val();
        $.post("chatlog.php", {text: sendto});
        alert(sendto);
    });

    var history = new XMLHttpRequest();
    var x = "";
    var msg = "";
    var msgid = "";
    var deleteButton = "";
    var editButton = "";
    
    history.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
    
            //***you can edit the design of chat history here***
            var myObj = JSON.parse(this.responseText);
            for (i = 0; i < myObj.length; i++) {
    
                x += "<form method='POST' action=''>"
                deleteButton = "<input type='submit' name='mDelete' value='Delete'/>";
                editButton = "<button onclick='editFunction(\""+myObj[i].text+"\",\""+myObj[i].id+"\")' >Edit</button>";
                msg = " "+myObj[i].from + ": " + myObj[i].text + " (" + myObj[i].date + ")</br>";
                msgid = "<input type='hidden' name='mId' value='"+myObj[i].id+"'></input>";
                x += deleteButton;
                x += editButton;
                x += msg;
                x += msgid;
                x += "</form>"
              }
    
            document.getElementById("showHistory").innerHTML = x;
         }
    };
    history.open("GET", "getChathistory.php", true);
    history.send();
    
});


function editFunction(txt, mid) {

    var newmsg = prompt("Edit message:", txt);
    if (newmsg != null || newmsg != "") {
        var obj = {'id': mid ,'text': newmsg };
        var req = JSON.stringify(obj);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "chatlog.php?mEdit="+req, true);
        xmlhttp.send();
    }
}