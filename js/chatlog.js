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

    var xmlhttp = new XMLHttpRequest();
    var x = "";
    var msg = "";
    var deleteButton = "";
    var mid = "";
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //***you can edit the design of chat history here***
            var myObj = JSON.parse(this.responseText);
            for (i = 0; i < myObj.length; i++) 
            {
                x += "<form method='POST' action=''>"
                deleteButton = "<input type='submit' name='mDelete' value='Delete'/>";
                x += deleteButton;
                msg = myObj[i].from + ": " + myObj[i].text + " (" + myObj[i].date + ")</br>";
                x += msg;
                mid = "<input type='hidden' name='mId' value='"+myObj[i].id+"'></input>";
                x += mid;
                x += "</form>"
            }
            document.getElementById("showHistory").innerHTML = x;
        }
    };
    xmlhttp.open("GET", "getChathistory.php", true);
    xmlhttp.send();
});