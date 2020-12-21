function checkusername()
{
    var username = document.getElementById("uiUsername");
    var m = document.getElementById("uiMessage");
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            m.innerHTML = xmlhttp.responseText;
        else if (xmlhttp.readyState == 1)
            m.innerHTML = "please wait...";
    }
    xmlhttp.open("GET", "checkusername.php?un="+username.value, false);
    xmlhttp.send();
}


/*function checkusername() {
    username = document.getElementById("uiUsername").value;
    document.getElementById("uiMessage").innerHTML = 'Please wait...';

    $.ajax({
        url: 'checkusername.php',
        type: 'POST',
        async: !1,
        //contentType: 'charset=utf-8',
        data: { un: username},
        success: function (data) {
            document.getElementById("uiMessage").innerHTML = data;
        }
    });

}*/