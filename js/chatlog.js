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
        if (this.readyState == 4 && this.status == 200) 
        {
            var myObj = JSON.parse(this.responseText);
            for (i = 0; i < myObj.length; i++) 
            {
                x += "<form method='POST' action=''>"
                deleteButton = "<input type='submit' name='mDelete' value='Delete'/>";
                editButton = "<button onclick='editFunction(\""+ myObj[i].text + "\",\"" + myObj[i].id + "\")' >Edit</button>";
                msg = " "+myObj[i].from + ": " + myObj[i].text + " (" + myObj[i].date + ")</br>";
                msgid = "<input type='hidden' name='mId' value='" + myObj[i].id + "'></input>";
                x += deleteButton;
                x += editButton;
                x += msg;
                x += msgid;
                x += "</form>"
              }
            document.getElementById("showHistory").innerHTML = x;
            ScrollToBottom();
         }
    };
    history.open("GET", "getChathistory.php", true);
    history.send();
    
    var status = new XMLHttpRequest();
    status.onreadystatechange = function() 
    {
    if (this.readyState == 4 && this.status == 200) 
    {
            if (this.responseText == 1)
            { //user has blocked the contact
                document.getElementById("unblockBtn").innerHTML = '<input type="submit" name="uiUnblock" value="Unblock"/>';
            }
            else if (this.responseText == 2)
            { //user has been blocked by the contact
                document.getElementById("blockStatus").innerHTML = "You Are Blocked!";
            }
            else
            { 
                document.getElementById("blockBtn").innerHTML = '<input type="submit" name="uiBlock" value="Block"/>'
            }
        }
    };
    status.open("GET", "getChatstatus.php", true);
    status.send();
});

function editFunction(txt, mid) 
{
    var newmsg = prompt("Edit message:", txt);
    if (newmsg != null || newmsg != "") 
    {
        var obj = {'id': mid ,'text': newmsg };
        var req = JSON.stringify(obj);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "chatlog.php?mEdit="+req, true);
        xmlhttp.send();
    }
}