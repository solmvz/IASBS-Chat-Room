$(document).ready(function(){ });

$("#uiSendmsg").click(function(){	
    var clientmsg = $("uiMsg").val();
    $.post("chatlog.php", {text: clientmsg});				
    $("uiMsg").attr("value", "");
    return false;
});

$(document).ready(function(){ 
$("#uiSendto").click(function(){
    var sendto = $("#uiSendto").val();
    $.post("userslist.php", {text: sendto});
    alert(sendto);

});
});

/*function openchatlog(){
    var sendto = document.getElementsByName("uiSendto")[1].value;
    document.write(sendto);
    
}*/

/*function loadLog(){		
    $.ajax({
        url: "view/log.html",
        cache: false,
        success: function(html){		
            $("#chatbox").html(html); //Insert chat log into the #chatbox div				
          },
    });
}*/

/*$(document).ready(function(){
    $("#uiDeletemsg").click(function(){
    $("#m1").remove();
  });
});
*/